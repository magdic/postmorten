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
$idFromProject= clean($_POST['idFromProject']);
$startDate = clean($_POST['startDate']);
$headline = clean($_POST['headline']);
$text = clean($_POST['text']);
$media = clean($_POST['media']);
$credit = clean($_POST['credit']);
$caption = clean($_POST['caption']);

$id = time() + (7 * 24 * 60 * 60);
$idEncryped = md5($id);
//echo md5($id);die();
//echo 'Project Name: '.$projectname;die();

$resultf = mysql_query("SELECT * FROM timelines where startDate='$startDate' AND headline='$headline' AND media='$media' AND caption='$caption' AND credit='$credit' AND idFromProject='$idFromProject'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['idtimelines'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Timeline Allready Added';
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
mysql_query("INSERT INTO timelines (startDate, headline, text, media, credit, caption, idFromProject)
VALUES ('$startDate','$headline','$text','$media', '$credit', '$caption', '$idFromProject')");
header("location: ../app/lead/timelines/edit.php?id=$idFromProject");