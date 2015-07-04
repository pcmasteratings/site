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
                        <td>
                            <?php
                                $platforms = $game->getValidPlatforms();
                                foreach($platforms as $plat) {
                                    if($plat["id"]==$platform->getId()) {
                                        echo $plat["title"];
                                    } else {
                                        echo '<a href="\game.php?name='.$game->getName().'&platform='.$plat['name'].'">'.$plat["title"].'</a>';
                                    }
                                }
                            ?>
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
                    ?>
				</table>
			</div>
			<div class="col-md-8">
				<p>GAME description goes here Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac nulla at arcu egestas convallis eget id odio. Curabitur magna felis, congue quis pretium id, pulvinar sed turpis. Praesent ac tortor tortor. In hac habitasse platea dictumst. Morbi fringilla sapien in lectus ultrices, quis varius sapien condimentum. Vivamus fringilla condimentum risus, nec egestas libero sagittis nec. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. </p>
			<br/>	
			<table class="table">
				<th>*</th><th>Individual reviews</th>
                <?php
                    $reviews = $game->getRatingHeaderss();
                    foreach($reviews as $review) {
                        if($review->getGamePlatformId()!=$platform->getId()) {
                            continue;
                        }
                        $rating = $review->getRating();
                        if($rating==null) {
                            print_r($review);
                        }
                        $user = $review->getUser();
                        echo '<tr><td style="width: 25px">';
                        echo '<img src="img/badges/'.$rating->getInitial().'_tiny.jpg" alt="'.strtoupper($rating->getInitial()).'" height="20"></td>';
                        echo '<td>review by <a href="https://www.reddit.com/user/'.$user->getUsername().'/">/u/'.$user->getUsername().'</a></td></tr>';
                    }
                ?>
			</table>
                <a href="submit_game.php?game=<?php echo $game->getName() ?>">Submit Review</a>
			</div>
		</div>
		<?php include("res/footer.php"); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="/js/bootstrap.js"></script>
	</body>
</html>
