<?php
//connect to the database so we can check, edit, or insert data to our users table
include('../../../../config/dbconfig.php');


$idRequested=$_REQUEST['id'];

$query=mysql_query("SELECT * FROM timelines WHERE idFromProject = '".$idRequested."'") or die(mysql_error());

# Collect the results
while($obj = mysql_fetch_object($query)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;
?>
