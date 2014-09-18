<?php
//connect to the database so we can check, edit, or insert data to our users table
include('../config/dbconfig.php');
$query=mysql_query("SELECT * FROM usersFromDB") or die(mysql_error());

# Collect the results
while($obj = mysql_fetch_object($query)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;
?>
