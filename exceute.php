<?php
echo 'starting ';

$server = "localhost";

$user = "root";

$password = "root";

$db = "prueba";

$connection = mysqli_connect($server, $user, $password, $db);


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
	echo 'conection works';
}


$result = mysqli_query($connection, "SELECT * FROM user LIMIT 10");


# Collect the results
while($obj = mysqli_fetch_object($result)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;

 // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 // 	$name = $row['nombre'];
 // 	echo '</br>This is: <b>'.$name.'</b></br>';
 // }
                            


    mysqli_free_result($result);


 	// echo '</br>end';

mysqli_close($connection);


?>