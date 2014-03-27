<?php
// //allow sessions to be passed so we can see if the user is logged in
session_start();

// //connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

// //include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";

include("functions.php");

?>
<!DOCTYPE html>
<html><head>
<title>PostMorten | Timeline </title>
<meta charset="UTF-8">
<meta name="description" content="" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="js/prettify.js"></script>                                   
<script type="text/javascript" src="js/kickstart.js"></script>                                  
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  
<link rel="stylesheet" type="text/css" href="style.css" media="all" />                          
</head><body>

<?php
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";die();
		}else if ($row['role'] != 3){
			echo "<center>You are not an <b>PM User</b> site!</center>";die();
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
		}
		//die();
			?>

<?php //SET JSON NAME TO CALL TIMELINE 
$idProject=$_REQUEST['id'];
$project_id = $idProject; 
?>

<a id="top-of-page"></a><div id="wrap" class="clearfix">
<div class="col_12">
<a href="./?id=<?php echo $project_id;?>">Home</a>
<a href="../timelines-to-me.php">My Projects</a>
<a href="testing-timeline.php?id=<?php echo $project_id;?>">See the Timeline Process</a>
<a href="https://github.com/magdic/postmorten" target="_blank">Github - Project Files</a>
<a href="details.php">PostMorten - Project Details</a>


