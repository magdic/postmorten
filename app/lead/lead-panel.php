<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome Lead User | my App</title>
</head>
<body>
	<?php
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else if ($row['role'] != 2){
			echo "<center>You are not an <b>Lead User</b> site!</center>";
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			
			?>
	<h1>Welcome Lead Panel</h1>

		<ul>
			<li><a href="">My Profile</a></li>
			<li><a href="lead-add-project.php">Create Project</a></li>
			<li><a href="add-pm-to-project.php">Hook PM to Project</a></li>
			<li><a href="../../logout.php">Log Out</a></li>
		</ul>



<?php
		
		//make sure you close the check if their online
		}
		
		?>
</body>
</html>
