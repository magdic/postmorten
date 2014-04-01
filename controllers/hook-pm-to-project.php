<?php

//allow sessions to be passed so we can see if the user is logged in
//session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../config/functions.php";


//Array to store validation errors
$errmsg_arr = array();
if (!isset($_SESSION)) {
session_start();

}

//Validacion de bandera de error
$errflag = false;
//Funcion para recibir valores del form. Previene SQL injection
function clean($str)
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc())
			{
			$str = stripslashes($str);
			}
		return mysql_real_escape_string($str);
	}

//Sanitize the POST values
$idP= clean($_POST['idProjectJO']);
$idUser = clean($_POST['idUsernameJO']);


$resultf = mysql_query("SELECT * FROM joinedTB where idProjectJO='$idP' AND idUsernameJO='$idUser'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['idProjectJO'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Project Allready Added';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	//header("location: login_ok.php");
	echo "Project added to PM user";
	exit();
	}
	}
	}
mysql_query("INSERT INTO joinedTB (idProjectJO, idUsernameJO)
VALUES ('$idP','$idUser')");
header("location: ../app/lead/add-pm-to-project.php");