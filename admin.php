<?php
require("res/include.php");

if(!Auth::checkIfAdmin()) {
    header("Location: /"); /* Redirect browser */
}
$user = Auth::getCurrentUser();

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
				<p><?php $game->getDescription(); ?></p>
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
                <a href="admin_game.php?game=<?php echo $game->getName() ?>">Submit Review</a>
			</div>
		</div>
		<?php include("res/footer.php"); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="/js/bootstrap.js"></script>
	</body>
</html>
