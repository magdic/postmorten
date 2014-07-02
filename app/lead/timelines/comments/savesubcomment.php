<?php

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../../config/functions.php";

$mcomment=$_POST['mcomment'];
$mesgid=$_POST['mesgid'];
$idProject=$_POST['idProject'];
$fullnameUser=$_POST['fullnameUserSub'];
$date = date('r',time());
mysql_query("INSERT INTO subComment (subComment, idComment, dateToday, userSubComment)
VALUES ('$mcomment','$mesgid','$date','$fullnameUserSub')");
header("location: ../timeline.php?id=".$idProject);
?>