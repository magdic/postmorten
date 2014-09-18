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

	mysql_query("UPDATE projectsTB SET headlineP='".$headline."', startDateP='".$date."', textP='".$text."', mediaP='".$media."', creditP='".$credit."', captionP='".$caption."' WHERE idtimeLine='".$id."'");

 	echo '<script>parent.window.location.reload(true);</script>';


 ?>