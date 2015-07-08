<?php
require("res/include.php");
if(!array_key_exists("name",$_GET)) {
    header("Location: /"); /* Redirect browser */
    exit();
} else {
    $query = new GamesQuery();
    $game = $query->findOneByName($_GET["name"]);
    if($game==null) {
        header("Location: /"); /* Redirect browser */
        exit();
    }
}

if(!array_key_exists("platform",$_GET)) {
    $platform = "windows";
} else {
    $platform = $_GET["platform"];
}
$query = new GamePlatformsQuery();
$platform = $query->findOneByName($platform);
if($platform==null) {
    throw new Exception("Invalid platform specified");
}

// Getting the rating queries the database each time, so we do it once here:
$rating = $game->getAverageRating($platform->getName());

$user = Auth::getCurrentUser();

if(Auth::checkIfAuthenticated()&&array_key_exists("submit_game_review",$_POST)&&array_key_exists("submit_game_rating",$_POST)) {
    $new_review = $_POST["submit_game_review"];
    $new_rating = $_POST["submit_game_rating"];

    $review =  UserReviews::getUserReview($game,$platform,$user);
    if($review==null) {
        $review = new UserReviews();
        $review->setGames($game);
        $review->setGamePlatforms($platform);
        $review->setUser($user);
    }
    $review->setRating($new_rating);
    $review->setReview(strip_tags($new_review, '<br><br/>'));
    $review->save();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("res/head.php"); ?>
		<link href="/css/bootstrap.min.css" rel="stylesheet" />
		<meta charset="UTF-8" />
	</head>
	<body>
		<?php include("res/nav.php"); ?>
		<div class="container">
			
			<h1><?php echo $game->getTitle(); ?></h1>
			<div class="col-md-4">
				<table class="table">
					<tr><td colspan="2" style="text-align:center; border-top: none;">
                            <img src="images/ratings/<?php echo $rating; ?>.jpg" height="150" />
                        </td></tr>
                    <tr>
                        <td  colspan="2">
                            <table style="width:100%";><tr>
                            <?php
                                $platforms = $game->getValidPlatforms();
                                foreach($platforms as $plat) {
                                    echo '<td style="width:30%;text-align:center;">';
                                    if($plat["id"]==$platform->getId()) {
                                        echo $plat["title"];
                                    } else {
                                        echo '<a href="/game.php?name='.$game->getName().'&platform='.$plat['name'].'">'.$plat["title"].'</a>';
                                    }
                                    echo '</td>';
                                }
                            ?>
                            </tr></table>
                        </td>
                    </tr>
					<th>Item</th><th>Score</th>
                    <?php
                    $query = new RatingCategoriesQuery();
                    $query->orderBySequence();
                    $result = $query->find();
                    foreach($result as $cat) {
                        echo '<tr><td>'.$cat->getTitle().'</td>';
                        echo '<td>'. $game->getAverageCategoryRatingDescription($platform->getName(), $cat->getId()) .'</td></tr>';
                    }

                    if(Auth::checkIfAdmin()) {
                        echo '<tr><td colspan="2"><a href="admin_game.php?game='.$game->getName().'&platform='.$platform->getName().'">Edit Ratings...</a></td></tr>';
                    }
                    ?>
				</table>
			</div>
			<div class="col-md-8">
				<p><?php $game->getDescription(); ?></p>
			<br/>	
			<table class="table">
				<th style="width: 25px">*</th><th style="width:100%;">User reviews</th><th>Review by</th>
                <?php
                    $query = new UserReviewsQuery();
                    $query->filterByGamePlatforms($platform);
                    $reviews = $query->findByGameId($game->getId());
                    if($reviews->count()==0) {
                        echo '<tr><td></td><td>No reviews submitted for this platform...</td></tr>';
                    }
                    foreach($reviews as $review) {
                        $rating = $review->getRatings();
                        if($rating==null) {
                            print_r($rating);
                            exit;
                        }
                        $review_user = $review->getUser();
                        echo '<tr><td>';
                        echo '<img src="img/badges/'.$rating->getInitial().'_tiny.jpg" alt="'.strtoupper($rating->getInitial()).'" height="20"></td>';
                        echo '<td >'.$review->getReview().'</td>';
                        echo '<td><a href="https://www.reddit.com/user/'.$review_user->getUsername().'/">/u/'.$review_user->getUsername().'</a></td></tr>';
                    }
                ?>
			</table>
                <?php if(Auth::checkIfAuthenticated()) : ?>
                    <form action="" method="POST">
                        <?php $review = UserReviews::getUserReview($game,$platform,$user); ?>
                        <div class="form-group">
                            <select name="submit_game_rating" class="form-control">
                                <?php

                                    $ratings = Ratings::getAllRatings();
                                    foreach($ratings as $rating) {
                                        echo '<option value="'.$rating->getId().'"';
                                        if($review!=null&&$review->getRating()==$rating->getId()) {
                                            echo ' selected="selected" ';
                                        }
                                        echo '>'.$rating->getTitle()."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-group" name="submit_game_review"><?php if($review!=null) { echo $review->getReview(); } ?></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" />
                    </form>
                <?php endif; ?>
 			</div>
		</div>
		<?php include("res/footer.php"); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="/js/bootstrap.js"></script>
	</body>
</html>
