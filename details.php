<?php






# First open the JSON file
$file = file_get_contents("example_json.json") or die("Cant open JSON file. Does it exist? Error code x51.");
#now check if it is a valid file
$json_debug = json_decode($file, true) or die("Cant decode JSON file. Is it a valid JSON file? Error code x61.");


include("header.php");

echo "<h1>TimelineJS - PostMorten</h1>";

echo "<hr /><h2>DOCUMENTATION</h2>";
echo "<pre>";
$documentation = array('Project Name' => 'PostMorten Site.', 
	'Company' => 'Hangar', 'Description' => 'Build a site that contains project info displayed with a TimeLine.',
	'Github path' => '(<a href="https://github.com/magdic/postmorten" target="_blank">https://github.com/magdic/postmorten.</a>)',
	'Collaborators' => 'Magdiel, Mauricio, Kike, Jairo, Randy.');
print_r($documentation);
echo "</pre>";

echo "<h2>JSON FILE</h2>";
echo "<h2>Format requiered by TimeLineJs</h2>";
echo "<pre>";
print_r($json_debug);
echo "</pre>";




echo "</div>";

include 'footer.php';
?>