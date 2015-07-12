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
        <h1>Rating System</h1>

        <p>PCMRatings is intended to provide objective scoring of the technical implementation of video games. Rather
            than rate games based on subjective properties, like artistic quality or "fun", they are marked with
            specific positive and negative traits.</p>

        <p>The rating system starts with a score of 0. Individual
            negative options subtract from that score, while positive options increase the score. The final score is
            compared against the minimum scores required for each rating to determine which rating a game receives.</p>


        <h2>Ratings</h2>
        <?php
        $ratings = RatingQuery::create()->orderByThreshold("DESC")->find();
        ?>
        <table>
            <tr>
                <th colspan="2">Rating</th>
                <th>Min. Score</th>
                <th>Comment</th>
            </tr>
            <?php foreach ($ratings as $rating): ?>
                <tr>
                    <td><img src="images/ratings/<?= $rating->getInitial() ?>.jpg" style="height: 50px;"/></td>
                    <td><?= $rating->getTitle() ?></td>
                    <?php if ($rating->getInitial() == "rp"): ?>
                        <td style="text-align: right;">N/A</td>
                    <?php else: ?>
                        <td style="text-align: right;"><?= $rating->getThreshold() ?></td>
                    <?php endif; ?>
                    <td><?= $rating->getDescription() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Rating Categories/Options</h2>

        <p>Scores are chosen based on the letter rating scale. The difference between "Righteous" and "Mediocre" is 10,
            so if a particular negative is bad enough to warrant going down a rating immediately, it would receive a
            score of -10. This is obviously unavoidably subjective, which is why we have chosen to use a list of
            specific options for the ratings. The letter rating of a game may fluctuate based on the overall attitude of
            the community toward specific options, but the chosen options themselves should continue to provide
            objective information about the game.</p>
        <table>
            <tr>
                <th>Category</th>
                <th>Option</th>
                <th>Sub-option</th>
                <th>Score</th>
                <th>Comments</th>
            </tr>


            <?php
            $categories = CategoryQuery::create()->orderBySequence()->find();
            $options = CategoryOptionQuery::create()->orderBySequence()->find();
            ?>
            <tr>
                <th>
                    <?php foreach ($categories as $category): ?>
                    <?= $category->getTitle() ?>
                    <?php foreach ($options as $option): ?>
                    <?php $sub_option_present = false; ?>
                    <?php if ($category->getId() == $option->getCategoryId() && $option->getParentId() == null): ?>
                </th>

                <td><?= $option->getDescription() ?></td>
                <?php foreach ($options as $sub_option): ?>
                <?php if ($sub_option->getParentId() == $option->getId()): ?>
                <?php $sub_option_present = true; ?>
                <td><?= $sub_option->getDescription() ?></td>
                <td style="text-align: right;"><?= $sub_option->getValue() ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!$sub_option_present): ?>
                    <td></td>
                    <td style="text-align: right;"><?= $option->getValue() ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <th>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endforeach; ?>

        </table>
        <h2>Changing options</h2>

        <p>It may be decided in the future to increase or decrease the score for a particular option to reflect better
            balance or changing priorities in the PC gaming world. Such changes will be decided by moderator consensus
            using feedback from the community.</p>

        <h2>Unfairly judging legacy games</h2>

        <p>Some negative options, such as a lack of multi-monitor support, may be attributed to an older game, but was
            considered acceptable at the time. In the interest of accuracy, the game should still be marked as having
            the negative option, but the option will be set to not contribute to the score. It will be up to the
            moderator (with public feedback) to determine if a game deserves the negative marks. The game page will
            clearly indicate when a negative does not contribute to the score</p>

        <h2>Re-evaluating games</h2>
        <p>Each game has a form for submitting information to contest the game's current rating.</p>
    </div>
    <div class="col-md-4">
        <h1>Contributors</h1>
        <ul>
            <li>ballisticge0rge
            <li>jens</li>
            <li>justin</li>
            <li>lonmoer</li>
            <li>macnetic</li>
            <li>nirkbirk</li>
            <li>northcode</li>
            <li>sanmadjack</li>
            <li>timeslapsey</li>
        </ul>
    </div>

</div>

<?php include("res/footer.php"); ?>

</body>
</html>
