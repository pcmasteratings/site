<?php
require("res/include.php");

if (!array_key_exists("name", $_GET)) {
    header("Location: /"); /* Redirect browser */
    exit();
} else {
    $query = new GameQuery();
    $game = $query->findOneByName($_GET["name"]);
    if ($game == null) {
        header("Location: /"); /* Redirect browser */
        exit();
    }
}

if (!array_key_exists("platform", $_GET)) {
    $platform = "windows";
} else {
    $platform = $_GET["platform"];
}
$query = new PlatformQuery();
$platform = $query->findOneByName($platform);
if ($platform == null) {
    throw new Exception("Invalid platform specified");
}

// Getting the rating queries the database each time, so we do it once here:
$header = $game->getRatingHeaderForPlatform($platform);

$rating = $game->getRatingForPlatform($platform);

$user = Auth::getCurrentUser();

if (Auth::checkIfAuthenticated() && array_key_exists("submit_game_review", $_POST) && array_key_exists("submit_game_rating", $_POST)) {
    $new_review = $_POST["submit_game_review"];
    $new_rating = $_POST["submit_game_rating"];

    $review = UserReview::getUserReview($game, $platform, $user);
    if ($review == null) {
        $review = new UserReview();
        $review->setGame($game);
        $review->setPlatform($platform);
        $review->setUser($user);
    }
    $review->setRatingId($new_rating);
    $review->setReview(strip_tags($new_review, '<br><br/>'));
    $review->save();
}

?>
<!DOCTYPE html>
<html>
<head>
    <?php include("res/head.php"); ?>
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <meta charset="UTF-8"/>
</head>
<body>
<?php include("res/nav.php"); ?>
<div class="container">

    <h1><?= $game->getTitle(); ?></h1>

    <div class="col-md-4">
        <table class="table">
            <tr>
                <td colspan="3" style="text-align:center; border-top: none;">
                    <img src="images/ratings/<?= $rating->getInitial(); ?>.jpg" height="150"
                         alt="<?= $rating->getTitle(); ?>"/>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:100%" ;>
                        <tr>
                            <?php
                            $platforms = $game->getPlatforms();
                            ?>

                            <?php if (sizeof($platforms) == 0): ?>
                                <td><b>Game has no platforms</b></td>
                            <?php endif; ?>
                            <?php foreach ($platforms as $plat): ?>
                                <td style="width:30%;text-align:center;">
                                    <?php if ($plat->getId() == $platform->getId()): ?>
                                        <?= $plat->getTitle() ?>
                                    <?php else: ?>
                                        <a href="/game.php?name=<?= $game->getName() ?>&platform=<?= $plat->getName() ?>"><?= $plat->getTitle() ?></a>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </td>
            </tr>

            <?php if ($header == null): ?>
                <tr>
                    <td colspan="3" style="font-weight: bold;">Pending official rating</td>
                </tr>
            <?php else: ?>
                <?php
                $categories = CategoryQuery::create()->orderBySequence()->find();
                $values = $header->getRatingValuesJoinCategoryOption();
                ?>
                <th>Category</th>
                <th colspan="2">Marks</th>
                <?php foreach ($categories as $category): ?>
                    <?php
                    $first = true;
                    ?>
                    <?php foreach ($values as $value): ?>
                        <?php if ($value->getCategoryOption()->getCategoryId() == $category->getId() && $value->getCategoryOption()->getParentId() == null): ?>
                            <tr>
                                <?php if ($first): ?>
                                    <td style="white-space: nowrap;"><?= $category->getTitle() ?></td>
                                <?php else: ?>
                                    <td style="white-space: nowrap;"></td>
                                <?php endif; ?>
                                <?php $first = false; ?>
                                <td>
                                    <div
                                        style="white-space: nowrap;"><?= $value->getCategoryOption()->getDescription() ?>
                                        <?php foreach ($values as $sub_value): ?>
                                            <?php if ($sub_value->getCategoryOption()->getParentId() == $value->getCategoryOption()->getId()): ?>
                                                - <?= $sub_value->getCategoryOption()->getDescription() ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td>

                                    <?php if ($value->getComments() != ""): ?>
                                        <a href="#" data-toggle="popover" title="Comments" data-content="<?= $value->getComments() ?>" data-trigger="hover"  data-placement="bottom"><img src="info.png" /></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>

            <?php endif; ?>

            <tr>
                <td colspan="3">
                    <?php if (Auth::checkIfAdmin()): ?>
                        <a href="admin_game.php?game=<?= $game->getName() ?>&platform=<?= $platform->getName() ?>">Edit Ratings...</a>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-8">
        <?php echo '<img src="' . $game->getGbImage() . '" style="height:200px;" />'; ?>
        <p><?php echo $game->getDescription(); ?></p>
        <br/>
        <table class="table">
            <th style="width: 25px">*</th>
            <th style="width:100%;">User reviews</th>
            <th style="white-space:nowrap;">Review by</th>
            <?php
            $query = new UserReviewQuery();
            $query->filterByPlatform($platform);
            $reviews = $query->findByGameId($game->getId());
            if ($reviews->count() == 0) {
                echo '<tr><td></td><td>No reviews submitted for this platform...</td><td></td></tr>';
            }
            foreach ($reviews as $review) {
                $rating = $review->getRating();
                if ($rating == null) {
                    exit;
                }
                $review_user = $review->getUser();
                echo '<tr><td>';
                echo '<img src="img/badges/' . $rating->getInitial() . '_tiny.jpg" alt="' . $rating->getTitle() . '" height="20"></td>';
                echo '<td >' . $review->getReview() . '</td>';
                echo '<td><a href="https://www.reddit.com/user/' . $review_user->getUsername() . '/">/u/' . $review_user->getUsername() . '</a></td></tr>';
            }
            ?>
        </table>
        <?php if (Auth::checkIfAuthenticated()) : ?>
            <form action="" method="POST">
                <?php $review = UserReview::getUserReview($game, $platform, $user); ?>
                <div class="form-group">
                    <?php if ($review == null): ?>
                        Submit
                    <?php else: ?>
                        Update
                    <?php endif; ?>
                    User Review
                    <select name="submit_game_rating" class="form-control">
                        <?php
                        $ratings = Rating::getAllRatings();
                        ?>
                        <?php foreach ($ratings as $rating): ?>
                            <?php if ($review != null && $review->getRatingId() == $rating->getId()): ?>
                                <option value="<?= $rating->getId() ?>"
                                        selected="selected"><?= $rating->getTitle() ?></option>
                            <?php else: ?>
                                <option value="<?= $rating->getId() ?>"><?= $rating->getTitle() ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="submit_game_review"><?php if ($review != null) {
                            echo $review->getReview();
                        } ?></textarea>
                </div>
                <input type="submit" class="btn btn-primary"/>
            </form>
            <form action="" method="POST">
                <div class="form-group">
                    Contest rating
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="submit_game_review"></textarea>
                </div>
                <input type="submit" class="btn btn-primary"/>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php include("res/footer.php"); ?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="/js/bootstrap.js"></script>
</body>
</html>
