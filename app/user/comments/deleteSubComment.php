<?php 




//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";

$id=$_POST['id'];

// echo $id;die();

mysql_query("DELETE FROM subComment WHERE idSubComment=".$id." ") or die(mysql_error());