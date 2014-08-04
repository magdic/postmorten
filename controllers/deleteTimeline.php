


<?php

//allow sessions to be passed so we can see if the user is logged in
//session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../config/functions.php";

$id=$_REQUEST['id'];
$idProject=$_REQUEST['project'];

// echo 'The id is: '.$id;die();

mysql_query("DELETE FROM timelines WHERE idtimelines='$id' AND idFromProject='$idProject'") or die(mysql_error());

// header("location: ../app/lead/timelines/edit.php?id=".$idProject);
// Header('Location: '.$_SERVER['PHP_SELF']);
 echo '<script>parent.window.location.reload(true);</script>';
?>