<?php


require_once "conectar.php";

$sql = "select * from user";
$res = mysql_query($sql, Conectar::con());
$row = mysql_fetch_Assoc($res);
$json = array(
    'Nombre' => $row['nombre'],
    'Correo' => $row['correo'],
    'Edad' => $row['edad'],
    'Habilidades' => array()
);

echo $json;


foreach($row as $val){
    $json['Habilidades'][] = $val;
}

$jsonencoded = json_encode($json,JSON_UNESCAPED_UNICODE);

$fh = fopen($row['username'].".json", 'w');
fwrite($fh, $jsonencoded);
fclose($fh);

echo 'sdsds';


?>