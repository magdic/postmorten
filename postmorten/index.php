<?php


include("header.php");


$id=$_GET['id'];
$result = mysql_query("SELECT * FROM projectTB where idP='$id'");

while($row = mysql_fetch_array($result))
  {
	$idproject=$row['idP'];
	$prjctName=$row['projectname'];
	$prjctRef=$row['reference'];
	$prjctStartDate=$row['startdate'];
}

echo "<ul class=\"tabs left\">";
echo "<li><a href=\"#maintab\">Timelines</a></li>";
echo "</ul>";


echo "<div id=\"maintab\" class=\"tab-content\">";


echo "<h2>Add Timelines</h2>";

echo "<p>";

showinputform("action.php");

echo "</p>";

echo "<p>";
echo "<h2>".$LANG["todo"]."</h2>";

listtasks($json_a,"open","table");

echo "</p>";


echo "</div> <!-- tab div -->";


echo "</div><!--col_12 -->";

echo "<div class=\"col_6\">";

echo "<h2>Info</h2><p>Timeline Post Morten, using Php code and save data to Json file, 
requiered by the plugin TimelineJS.
<a href=\"http://timeline.knightlab.com/\" target=\"_blank\">http://timeline.knightlab.com/</a></p><p><b>Startup Intern Project version: 1.0</b></p>";

echo "</div> <!-- col_ -->";


include("footer.php");
