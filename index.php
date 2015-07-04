<?php

require("res/include.php");

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/index.css">
    <?php include("res/head.php"); ?>
    <title>PC Masterratings</title>

</head>
<body>
<?php include("res/nav.php"); ?>

<div class="container">
    <div class="col-md-8">
        <h1>Most recent games</h1>
        <?php
            $query = new GamesQuery();
            $query->limit(6);
            $query->orderById("DESC");
            $games = $query->find();


            $i = 0;
            foreach($games as $game) {
                if($i%3==0) {
                    echo '<div class="row">';
                }
                echo '<div class="col-sm-6 col-md-4"><div class="thumbnail">';
                echo '<a href="game.php?name='.$game->getName().'">';
                echo '<img src="'.$game->getGbThumb().'" alt="thumbnail">';
                echo '<img class="rating-badge" src="/img/badges/'.$game->getAverageRatingForDefaultPlatform().'_tiny.jpg" alt="R">';
                echo '<div class="caption"><h3>'.$game->getTitle().'</h3></div>';
                echo '</a>';
                echo '</div></div>';
                if($i%3==0) {
                    echo '</div>';
                }
                $i++;
            }
        ?>
    </div>
    <div class="col-md-4">
        <h1>Other stuff</h1>
    </div>

</div>

<?php include("res/footer.php"); ?>

</body>
</html>
