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

$resultf = mysql_query("SELECT * FROM joinedTB where idUsernameJO='$idUser' AND idProjectJO='$idP'");
while($rowf = mysql_fetch_array($resultf))
    {
    $cccvvv=$rowf['idUser'];
    if ($cccvvv!=''){
    //Login failed
    $errmsg_arr[] = 'User already added';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //header("location: login_ok.php");
    echo "User added to project";
    exit();
    }
    }
    }
mysql_query("INSERT INTO joinedTB (idUsernameJO, idProjectJO)
VALUES ('$idUser','$idP')");
header("location: ../app/pm/add-users-to-project.php");
