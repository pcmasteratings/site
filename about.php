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

        <h2>Rating Categories</h2>
        <table>
        <?php
            $categories = CategoryQuery::create()->orderBySequence()->find();

            foreach($categories as $category) {
                echo "<tr><th><h4>{$category->getTitle()}</h4></th></tr>";
                echo "<tr><th>Option</th><th>Value</th></tr>";
                $options = CategoryOptionQuery::create()->orderByValue("ASC")->filterByCategory($category)->find();
                foreach($options as $option) {
                    echo "<tr><td>{$option->getDescription()}</td><td>{$option->getValue()}</td></tr>";
                }
            }
        ?>
        </table>
        <h2>Ratings</h2>
        <table>
            <tr><th colspan="2">Rating</th><th>Minimum Score</th></tr>
        <?php
        $ratings = RatingQuery::create()->orderByThreshold("ASC")->find();
        foreach($ratings as $rating) {
            echo '<tr><td><img src="images/ratings/'.$rating->getInitial().'.jpg" height="150" alt="'.$rating->getTitle().'" /></td>';
            echo "<td>{$rating->getDescription()}</td>";
            if($rating->getThreshold()==-1) {
                echo "<td>N/A</td></tr>";
            } else {
                echo "<td>{$rating->getThreshold()}</td></tr>";
            }
        }
        ?>
        </table>
    </div>
    <div class="col-md-4">
        <h1>Contributors</h1>
        A bunch of dorks
    </div>

</div>

<?php include("res/footer.php");  ?>

</body>
</html>
