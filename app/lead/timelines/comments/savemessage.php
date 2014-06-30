<?php

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../../config/functions.php";

$msgcon=$_POST['message'];
$idProject=$_POST['idProject'];
$userComment=$_POST['userComment'];
$date = date('r',time());
mysql_query("INSERT INTO comment (bodycomment, idProject, dateToday, userComment)
VALUES ('$msgcon','$idProject','$date','$userComment')");
header("location: ../timeline.php?id=".$idProject);
?>