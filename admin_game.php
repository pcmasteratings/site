<?php
require("res/include.php");

if(!Auth::checkIfAdmin()) {
    header("Location: /"); /* Redirect browser */
}
$user = Auth::getCurrentUser();
$game = null;
$platform = null;

if(!array_key_exists("game",$_GET)||!array_key_exists("platform",$_GET)) {
    header("Location: /"); /* Redirect browser */
    exit();
} else {
    $query = new GamesQuery();
    $game = $query->findOneByName($_GET["game"]);
    $query = new PlatformsQuery();
    $platform = $query->findOneByName($_GET["platform"]);
    if($game==null||$platform==null) {
        header("Location: /"); /* Redirect browser */
        exit();
    }
}

$header = RatingHeadersQuery::create()->filterByGames($game)->filterByPlatforms($platform)->findOne();

if(array_key_exists("category_options_1",$_POST)) {
    $con = \Propel\Runtime\Propel::getConnection();
    $con->beginTransaction();
    try {
        if(!Auth::checkIfAuthenticated()) {
            throw new Exception("User not authenticated");
        }

        $user = Auth::getCurrentUser();

        if($header==null) {
            $header = new RatingHeaders();
            $header->setGameId($game->getId());
            $header->setCreated(new DateTime());
            $header->setPlatforms($platform);
        } else {
            RatingCategoryValuesQuery::create()->filterByRatingHeaders($header)->deleteAll($con);
        }
        $header->setUpdated(new DateTime());
        $header->setUserId($user->getId());
        $header->save($con);

        $score = 0;



        $query = new RatingCategoriesQuery();
        $categories = $query->find($con);

        foreach($categories as $category) {
            if(!array_key_exists('category_options_'.$category->getId(),$_POST)) {
                throw new Exception("No value found for category #".$category->getId());
            }
            $selected = $_POST['category_options_'.$category->getId()];

            $query = new RatingCategoryOptionsQuery();
            $option = $query->findOneById($selected);
            if($option==null) {
                throw new Exception("Could not find option #".$selected);
            }

            $val = new RatingCategoryValues();
            $val->setRatingHeaders($header);
            $val->setRatingCategories($category);
            $val->setRatingCategoryOptions($option);
            $val->setOriginalValue($option->getValue());
            $val->setOriginalWeightedValue($option->getValue() * $category->getWeight());
            $val->save();

            $score += ($option->getValue() * $category->getWeight());
        }
        $header->setScore($score);
        $header->save();

        $con->commit();
        header("Location: /game.php?name=". $game->getName()."&platform=". $platform->getName()); /* Redirect browser */
    } catch (Exception $e) {
        $con->rollback();
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<!-- saved from url=(0026)http://alessandro.pw/pcmr/ -->
<html xmlns="http://www.w3.org/1999/html">
	<head>


		<?php include("res/head.php"); ?>

		<meta charset="UTF-8" />
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
			<h4>Select all that apply</h4>


    <div class="row">
        <form action="" method="POST">
      <table class="u-full-width">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php

        $query = new RatingCategoriesQuery();
            $query->orderBySequence();

            $results = $query->find();

            foreach($results as $cat) {
                echo "<tr>";
                echo '<td class="score category">'. $cat->getTitle() .'</td>';
                $current_value = null;
                if($header!=null) {
                    $current_value = $header->getRatingForCategory($cat);
                }
                $options = $cat->getRatingCategoryOptionss();
                foreach($options as $option) {
                    echo '<td class="score description"><label>';
                    echo '<input name="category_options_'.$cat->getId().'" type="radio" value="'.$option->getId().'"';
                    if($current_value!=null&&$current_value->getRatingCategoryOptionId()==$option->getId()) {
                        echo ' checked="checked" ';
                    }
                    echo '>';
                    echo '<span class="label-body">'.$option->getDescription().'</span>';
                    echo '</label></td>';
                }
                echo "</tr>";
            }
        ?>
        </tbody>
      </table>
            <input type="submit" value="Submit" />
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
