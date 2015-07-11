<?php
require("res/include.php");

if (!Auth::checkIfAuthenticated()||!Auth::checkIfAdmin()) {
    header("Location: /"); /* Redirect browser */
}
$user = Auth::getCurrentUser();
$game = null;
$platform = null;

$con = \Propel\Runtime\Propel::getConnection();

if (!array_key_exists("game", $_GET) || !array_key_exists("platform", $_GET)) {
    header("Location: /"); /* Redirect browser */
    exit();
} else {
    $con->beginTransaction();
    $game = GameQuery::create()->filterByName($_GET["game"])->findOne($con);
    $platform = PlatformQuery::create()->filterByName($_GET["platform"])->findOne($con);
    if ($game == null || $platform == null) {
        header("Location: /"); /* Redirect browser */
        exit();
    }
}

$header = RatingHeaderQuery::create()->filterByGame($game)->filterByPlatform($platform)->findOne($con);

$categories = CategoryQuery::create()->orderBySequence()->find($con);

$options = CategoryOptionQuery::create()->orderBySequence()->find($con);

if (array_key_exists("rating_submit", $_POST)) {
    try {
        if ($header == null) {
            $header = new RatingHeader();
            $header->setGame($game);
            $header->setPlatform($platform);
            $header->setCreated(new DateTime());
            $header->save($con);
        } else {
            RatingValueQuery::create()->filterByRatingHeader($header)->deleteAll($con);
        }

        $score = 0;

        RatingValueQuery::create()->filterByRatingHeader($header)->deleteAll($con);

        foreach ($options as $option) {
            if(array_key_exists('option_'.$option->getId(), $_POST)) {
                $selected = $_POST['option_' . $option->getId()];
                if($selected=="na") {
                    continue;
                }

                $value = new RatingValue();
                $value->setRatingHeader($header);
                $value->setCategoryOption($option);
                $value->setOriginalValue($option->getValue());

                if($selected=="adns") {
                    $value->setDoNotScore(true);
                }


                if(array_key_exists('comments_'.$option->getId(),$_POST)) {
                    $value->setComments($_POST['comments_'.$option->getId()]);
                } else {
                    $value->setComments("none");
                }
                $value->save($con);

                if(array_key_exists('sub_option_'.$option->getId(),$_POST)) {
                    $sub_value = new RatingValue();
                    $sub_value->setRatingHeader($header);
                    $sub_option = CategoryOptionQuery::create()->filterById($_POST['sub_option_'.$option->getId()])->findOne($con);
                    if($sub_option==null) {
                        throw new Exception("Sub option ID not found: ".$_POST['sub_option_'.$option->getId()]);
                    }

                    $sub_value->setCategoryOption($sub_option);
                    $sub_value->setOriginalValue($sub_option->getValue());

                    $sub_value->save($con);
                    $score += ($sub_option->getValue());
                }

                $score += ($option->getValue());
            }
        }
        $header->setUpdated(new DateTime());
        $header->setScore($score);
        $header->save($con);

        $con->commit();
        header("Location: /game.php?name=" . $game->getName() . "&platform=" . $platform->getName()); /* Redirect browser */
    } catch (Exception $e) {
        $con->rollback();
        echo $e->getMessage();
        echo $e->getTraceAsString();
        exit;
    }
}
    $current_option_array = [];
if ($header != null) {
    foreach ($header->getRatingValues() as $value) {
        $current_option_array[$value->getCategoryOptionId()] = $value;
    }
}

?>
<!DOCTYPE html>
<!-- saved from url=(0026)http://alessandro.pw/pcmr/ -->
<html xmlns="http://www.w3.org/1999/html">
<head>


    <?php include("res/head.php"); ?>

    <meta charset="UTF-8"/>
    <meta name="description" content="this site may come in handy to compute PCMRatings">
    <meta name="author" content="/u/eur0pa">
    <meta name="generator" content="skeleton css">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="./PCMR Rating System calculator_files/css" rel="stylesheet" type="text/css">
    <link href="./localhost/css" rel="stylesheet" type="text/css">

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="http://localhost/css/normalize.css">
    <link rel="stylesheet" href="http://localhost/css/skeleton.css">
    <link rel="stylesheet" href="http://localhost/css/main.css">
</head>
<body>

<?php include("res/nav.php"); ?>
<div class="container">
    <h4>Game: <?php echo $game->getTitle(); ?></h4>
    <h4>Platform: <?php echo $platform->getTitle(); ?></h4>

    <p>
        Use the drop-down next to each option to select whether a particular option applies to the selected
        game/platform.
    <ul>
        <li>N/A - Option is not applicable.</li>
        <li>Applicable - Option is applicable.</li>
        <li>Applicable (DNS) - Option is applicable, but should not contribute to the score.</li>
    </ul>
    </p>


    <div class="row">
        <form action="" method="POST">
            <input type="hidden" name="rating_submit" value="1" />
            <table class="u-full-width">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Option</th>
                    <th>Applicability</th>
                    <th>Sub-option</th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                    <th class="score category" style="white-space: nowrap;"><?= $category->getTitle() ?></th>
                    <?php foreach ($options as $option): ?>
                        <?php if ($option->getCategoryId() == $category->getId() && $option->getParentId() == null): ?>
                            <?php
                            $current_value = null;
                            if (array_key_exists($option->getId(), $current_option_array)) {
                                $current_value = $current_option_array[$option->getId()];
                            }
                            ?>
                            <td>
                                <?= $option->getDescription() ?>
                            </td>
                            <td>
                                <select name="option_<?= $option->getId() ?>">
                                    <?php if ($current_value == null): ?>
                                        <option value="na" selected="selected">N/A</option>
                                    <?php else: ?>
                                        <option value="na">N/A</option>
                                    <?php endif; ?>
                                    <option value="a">Applicable</option>
                                    <option value="adns">Applicable (DNS)</option>
                                </select>
                            </td>
                            <td>
                                <?php $first_sub_option = true; ?>
                                <?php foreach ($options as $sub_option): ?>
                            <?php if ($sub_option->getParentId() == $option->getId()): ?>
                            <?php if ($first_sub_option): ?>
                                <select name="sub_option_<?= $option->getId() ?>">
                                    <?php $first_sub_option = false; ?>
                                    <?php endif; ?>
                                    <option value="<?= $sub_option->getId() ?>"><?= $sub_option->getDescription() ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (!$first_sub_option): ?>
                                </select>
                            <?php endif; ?>
                            </td>
                            <td>
                                <textarea name="comment_<?= $option->getId() ?>">
                                    <?php if($current_value!=null): ?>
                                        <?= $current_value->getComments() ?>
                                    <?php endif; ?>
                                </textarea>
                            </td>
                            </tr>
                            <tr>
                            <td></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <input type="submit" value="Submit"/>
        </form>
    </div>

    <!-- Footer
    ________________________________________________ -->
    <div class="row">
        <div class="u-full-width" style="margin-top: 0%">
            <footer>
                <p>
                    <!-- Based on <a href="http://www.reddit.com/r/pcmasterrace">/r/PCMR</a> user ratings.
                    Credits go to <a href="http://www.reddit.com/user/BallisticGE0RGE">/u/BallisticGE0RGE</a> for the images.
                    Original thread <a href="http://redd.it/3b6eic">here</a> -->
                </p>
            </footer>
        </div>
    </div>
    <!--
      </div>

       End Document
      ––––––––––––––––––––––––––––––––––––––––––––––––––

                <table class="table">
                    <th>*</th><th>Individual reviews</th>
                    <tr><td style="width: 25px"><img src="img/badges/r_tiny.jpg" alt="R" height="20"></td><td>review by /u/pedro19</td></tr>
                </table>
                </div>
            </div>-->
    </div>
    <?php include("res/footer.php"); ?>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="./PCMR Rating System calculator_files/jquery.min.js"></script>
    <script src="./PCMR Rating System calculator_files/main.js"></script>
    <script src="js/main.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="Jquery-1.4.2-min.js"></script>
    <script src="FloatingHeader.js"></script>
</body>
</html>
