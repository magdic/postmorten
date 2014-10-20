<?php 

	//allow sessions to be passed so we can see if the user is logged in
	session_start();

	//connect to the database so we can check, edit, or insert data to our users table
	include "../config/dbconfig.php";

	//include out functions file giving us access to the protect() function
	include "../config/functions.php";


	$id = $_POST['idUser'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$position = $_POST['position'];
	$department = $_POST['department'];

	mysql_query("UPDATE usersFromDB SET nameFDB='".$name."', lastNameFDB='".$lastname."', position=".$position.", department='".$department."' WHERE idDB='".$id."'");

 	// echo '<script>parent.window.location.reload(true);</script>';
 	header("location: ../app/admin/editUser.php?id=".$id."");


 ?>