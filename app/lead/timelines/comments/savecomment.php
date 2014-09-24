<?php

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../../config/functions.php";

$msgcon=protect($_POST['message']);
$idProject= protect($_POST['idProject']);
$userComment= protect($_POST['userComment']);
// $date = date('r',time());
$insert_sql = "INSERT INTO comment (bodycomment, idProject, userComment)
VALUES ('".$msgcon."','".$idProject."',".$userComment.")";


// print var_dump($insert_sql);die();

mysql_query($insert_sql);

header("location: ../timeline.php?id=".$idProject);
// unset($_POST['message']);
?>