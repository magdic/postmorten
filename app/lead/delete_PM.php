<?php

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

$id=$_GET['id'];

echo '<h1>This id '.$id.' has been deleted</h1>';

mysql_query("DELETE FROM joinedTB WHERE idJO='$id'") or die(mysql_error());
echo '<script>window.location.href="add-pm-to-project.php"</script>';


?>