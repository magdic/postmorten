<?php 

	//allow sessions to be passed so we can see if the user is logged in
	session_start();

	//connect to the database so we can check, edit, or insert data to our users table
	include "../config/dbconfig.php";

	//include out functions file giving us access to the protect() function
	include "../config/functions.php";


	$id = $_POST['id'];
	$idFromProject = $_POST['idFromProject'];
	$headline = $_POST['headline'];
	$date = $_POST['startDate'];
	$text = $_POST['text'];
	$media = $_POST['media'];
	$credit = $_POST['credit'];
	$caption = $_POST['caption'];

	mysql_query("UPDATE timelines SET headline='".$headline."', startDate='".$date."', text='".$text."', media='".$media."', credit='".$credit."', caption='".$caption."' WHERE idtimelines='".$id."' AND idFromProject='".$idFromProject."'");

 	echo '<script>parent.window.location.reload(true);</script>';


 ?>