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
        $query = new GameQuery();
        $query->limit(6);
        $query->innerJoinRatingHeader();
        $query->orderById("DESC");
        $games = $query->find();

        $i = 1;
        ?>

        <?php foreach ($games as $game): ?>
            <?php if ($i % 3 == 0): ?>
                <div class="row">
            <?php endif; ?>
            <?php $rating = $game->getRatingForDefaultPlatform(); ?>

            <div class='col-sm-6 col-md-4'>
                <div class='thumbnail'>
                    <a href="game.php?name=<?= $game->getName(); ?>">
                        <img src="<?= $game->getGbThumb(); ?>" alt='thumbnail'>
                        <img class='rating-badge'
                             src="/img/badges/<?= $rating->getInitial() ?>_tiny.jpg"
                             alt="<?= strtoupper($rating->getTitle()) ?>">

                        <div class='caption'><h3><?= $game->getTitle() ?></h3></div>
                    </a>
                </div>
            </div>
            <?php if ($i % 3 == 0): ?>
                </div>
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <h1>Anouncements</h1>
        <?php
            $newses = NewsQuery::create()->orderByDatetime("DESC")->limit(4)->find();
        ?>
        <?php foreach($newses as $news): ?>
        <div class="row">
            <?= $news->getTitle() ?>
            <?= $news->getContent()?>
            <?= $news->getUser()->getUsername() ?>
            <?= $news->getDatetime()->format('Y-m-d H:i:s') ?>
        </div>
        <?php endforeach ?>
    </div>

</div>

<?php include("res/footer.php"); ?>

</body>
</html>
