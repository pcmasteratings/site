<pre>
<?php
$start= "It's good to yell at people and tell people that you're from Tennesee, so that way you'll be safe. The best way to communicate is compatible. Compatible communication is listening with open ears and an open mind, and not being fearful or judgemental about what you're hearing.	";
require_once("res/include.php");
echo "start";
echo "<br/>";
$name = Games::generateUniqueName($start, "2010");
echo $name;
$game = new Games();
$game->setName($name);
$game->save();
echo "<br/>";
$name = Games::generateUniqueName($start, "2010");
echo $name;

echo "<br/>";
echo "end";
?>
</pre>
