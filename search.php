<?php

require('res/include.php');

?>
<!DOCTYPE html>
<html>
<head>
  <link rel='stylesheet' href='/css/index.css'>
  <?php include('res/head.php'); ?>
  <title>PC Masterratings</title>

</head>
<body>
  <?php include('res/nav.php');

  //if is post
  if(isset($_POST['btnSearch']))
  {
    $games = [];
    $limit = 10;
    try
    {
      $games = GBApi::searchForGames($_POST['txtSearch'], $limit);
    }
    catch(GBApiException $e)
    {
      //VERY rudimentary error handling - change this!!
      echo '<h3>', $e, '<h3>';
      exit;
    }
    $cols = 3; //change to whatever, but you'll have to mess with bootstrap classes to make it display properly
    $rows = ceil(count($games) / $cols);

    //Try to generate search results
    //This is a gross way of generating html
    echo "<h1>Results</h1>
      <div class='container'>";
    for ($i = 0; $i < $rows; $i++)
    {
      echo "<div class='row'>";
      for ($k = 0; $k < $cols; $k++)
      {
        $index = $cols * $i + $k;
        if (isset($games[$index]))
        {
          $game = $games[$index];
          echo "<div class='col-sm-6 col-md-4'>
            <div class='thumbnail'>
              <a href='game.php?name={$game->getName()}'> 
                <img src='{$game->getGbThumb()}' alt='no thumb'>
                  <div class='caption'><h3>{$game->getTitle()}</h3><p>{$game->getDescription()}</p></div>
              </a>
            </div>
          </div>";
        }
        else
        {
          break;
        }
      }

      echo "\n</div>"; //Close row
    }
    echo "\n</div>"; //Close container
  }
  ?>

  <?php include('res/footer.php'); ?>

</body>
</html>
