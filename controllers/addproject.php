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
$projectname= clean($_POST['projectname']);
$reference = clean($_POST['reference']);
$startdate = clean($_POST['startdate']);
//$id = substr(md5(rand()), 0, 20);

$id = time() + (7 * 24 * 60 * 60);
$idEncryped = md5($id);
//echo md5($id);die();
//echo 'Project Name: '.$projectname;die();

$resultf = mysql_query("SELECT * FROM timeProject where headlineP='$projectname' AND textP='$reference' AND startDateP='$startdate'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['headlineP'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Project Allready Added';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	//header("location: login_ok.php");
	echo "Error";
	exit();
	}
	}
	}
mysql_query("INSERT INTO timeProject (idtimeLine, headlineP, textP, startDateP)
VALUES ('$idEncryped','$projectname','$reference','$startdate')");
header("location: ../app/lead/lead-panel.php");