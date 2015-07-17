<?php

require("res/include.php");

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/index.css">
    <?php include("res/head.php"); ?>
    <title>PC Master Ratings - About</title>

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
                    <td><img src="img/badges/<?= $rating->getInitial() ?>.jpg" style="height: 50px;"/></td>
                    <td><?= $rating->getTitle() ?></td>
                    <?php if ($rating->getInitial() == "rp"): ?>
                        <td style="text-align: right;">N/A</td>
                    <?php elseif ($rating->getInitial() == "p"): ?>
                        <td style="text-align: right;">< -50</td>
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
        <p>Unfortunately even within this, some options are prone to subjectivity. The "stability" of a game, or its servers,
            is in this categorized by the inherently subjective phrases "Major", or "Moderate". Where we can we will be adding
            exact, objective options to be used as alternatives to these, but there will always be fringe issues that defy classification.
            As such, these options are available but are intended to be used sparingly and with definitive proof. We encourage users
            to contest and propose more specific options whenever they end up being used. Our current plan is to err on the side of caution and prefer to not contestable options, we'd rather not jump the gun and add negative marks hastily when they're not deserved.</p>
        <p>Justifications for options will be provided when available, and can be read by hovering the mouse over the option on a game's page.</p>
        <table border="1">
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
                    <?php $sub_option_count = 0; ?>
                    <?php if ($category->getId() == $option->getCategoryId() && $option->getParentId() == null): ?>
                </th>

                <td><?= $option->getDescription() ?></td>
                <?php
                foreach ($options as $sub_option) {
                    if ($sub_option->getParentId() == $option->getId()) {
                        $sub_option_count++;
                    }
                }
                $first_sub_option = true;
                ?>
                <?php foreach ($options as $sub_option): ?>
                <?php if ($sub_option->getParentId() == $option->getId()): ?>
                <td><?= $sub_option->getDescription() ?></td>
                <td style="text-align: right;"><?= $sub_option->getValue() ?></td>
                <?php if($first_sub_option): ?>
                <td rowspan="<?= $sub_option_count ?>"><?= $option->getComment() ?></td>
                <?php $first_sub_option =false; ?>
                <?php endif; ?>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($sub_option_count==0): ?>
                    <td></td>
                    <td style="text-align: right;"><?= $option->getValue() ?></td>
                    <td><?= $option->getComment() ?></td>
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

        <h2>Proposing/Contesting game ratings</h2>

        <p>We're making use of Voat to enable people to propose and discuss game ratings at <a href="https://voat.co/v/PCMRatings/" target="_blank">https://voat.co/v/PCMRatings/</a> We will make sure to pay attention to posts there that are marked as submissions, but if it seems we've missed one just PM a mod.</p>
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
