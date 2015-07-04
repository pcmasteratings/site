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
  <?php include('res/nav.php'); ?>

  <div class='container'>
    <form action='' method='post'> <!-- Post back to same page. -->
      <div class='input-group'>
        <span class='input-group-btn'>
          <button name='btnSearch' type='submit' class='btn btn-success' aria-label='Left Align'>
            <span class='glyphicon glyphicon-search' aria-hidden='true'></span> Search
          </button>
        </span>
        <input name='txtSearch' type='text' class='form-control' placeholder='e.g. Deus Ex: Invisible War'>
      </div>
    </form>
  </div>

  <?php
  //if is postback
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
      echo $e;
      exit;
    }
    $cols = 3; //change to whatever, but you'll have to mess with bootstrap classes to make it display properly
    $rows = ceil(count($games) / $cols);

    //Try to generate search results
    //This is a gross way of generating html
    echo "<div class='container'>
    <div class='col-md-8'>
    <h1>Results</h1>";
    for ($i = 0; $i < $rows; $i++)
    {
      for ($k = 0; $k < $cols; $k++)
      {
        $index = $cols * $i + $k;
        if (isset($games[$index]))
        {
          $game = $games[$index];
          echo "<div class='col-sm-6 col-md-4'>
            <div class='thumbnail'>
            <img src='{$game->getGbImage()}' alt='{$game->getName()}'>
              <div class='caption'>
                <h3>{$game->getTitle()}</h3>
                <p> {$game->getDescription()} </p>
              </div>
          </div>
        </div>";
        }
        else
        {
          break;
        }
      }
    }
    echo "</div>
    </div>"; //Close col & container
  }
?>

<?php include('res/footer.php'); ?>

</body>
</html>
