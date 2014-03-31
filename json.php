<?php
$sql = "SELECT * FROM timeProject WHERE idtimeLine = 1"; //ejemplo frutería: SELECT id_fruta,nombre_fruta,cantidad FROM tabla_fruta;

$sql2 = "SELECT * FROM timeProject AS a, timelines AS b WHERE b.idFromProject = a.idtimeLine AND b.idFromProject='1'"; 

//split all fields fom the correct row into an associative array
$rowX = mysql_fetch_array($sql2);

echo $rowX['headlineP'];

function connectDB(){

        $server = "localhost";
        $user = "root";
        $pass = "root";
        $bd = "loginTut";

    $conexion = mysqli_connect($server, $user, $pass,$bd);

        if($conexion){
            //echo 'La conexion de la base de datos se ha hecho satisfactoriamente';
        }else{
            echo 'Ha sucedido un error inexperado en la conexion de la base de datos';
        }

    return $conexion;
}

function disconnectDB($conexion){

    $close = mysqli_close($conexion);

        if($close){
            //echo 'La desconexion de la base de datos se ha hecho satisfactoriamente';
        }else{
            echo 'Ha sucedido un error inexperado en la desconexion de la base de datos
';
        }   

    return $close;
}

//function getArraySQL($sql){
    //Creamos la conexión con la función anterior
    $conexion = connectDB();

    //generamos la consulta

        mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql2)) die(); //si la conexión cancelar programa

    $rawdata = array(); //creamos un array

    //guardamos en un array multidimensional todos los datos de la consulta
    $i=0;

    $testarr = array(
            'headline'=>'name',
            'type'=>'default',
            'text'=>'Lorem ipsum ip amen',
            'startDate'=>'2000,09,28'
        );

        $firstArray = json_encode($testarr);

        echo '{"timeline":'.str_replace("\"}", ',', $firstArray);

        //echo '{"timeline":'.json_encode($testarr);
    while($row = mysqli_fetch_array($result))
    {       
         $rawdata[$i] = $row;
            $i++;

        $array = array(
            // 'headline' => $row['headlineP'],
            // 'type' => 'default',
            // 'text' => $row['textP'],
            // 'startDate' => $row['startDateP'],
            'date' => array(array(
                'startDate'=>$row['startDate'], 
                'headline'=>$row['headline'], 
                'text'=>$row['text'], 
                'asset'=>array(
                'media'=>$row['media'],
                'credit'=>$row['credit'],
                'caption'=>$row['caption']
                ),),
            )
        );


        $print = json_encode($array);
        $search = array("{\"date\"",$row\[\'caption\'\]);
        $replace = array('"date"','"CAPULINA');
        echo str_replace($search, $replace, $print);

        // $rawdata[$i] = $row;
        // $i++;
        // $id = $row['idtimeLine'];
        // $headline = $row['headlineP'];
        // $type = $row['typeP'];
        // $text = $row['textP'];
        // $startdate = $row['startDateP'];
        // $idTimeline = $row['idtimeLine'];
        // $idtimelines = $row['idtimelines'];
        // $startDateTL = $row['startDate'];
        // $headlineTL = $row['headline'];
        // $textTL = $row['text'];
        // $mediaTL = $row['media'];
        // $creditTL = $row['credit'];
        // $captionTL = $row['caption'];
        // $idFromProject = $row['idFromProject'];
        // $print = json_encode($row);

        //echo 'e is numeric: '.is_numeric('e');


        $search = array(
        /**/   '"0":"'.$id.'","idtimeLine":"'.$id.'","1":"'.$headline.'","headlineP":"'.$headline.'","2":"default","typeP":"default","3":"'.$text.'","textP":"'.$text.'","4":"'.$startdate.'","startDateP":"'.$startdate.'",',    
               '"5":"'.$idtimelines.'","idtimelines":"'.$idtimelines.'","6":"'.$startDateTL.'","startDate":"'.$startDateTL.'","7":"'.$headlineTL.'","headline":"'.$headlineTL.'","8":"'.$textTL.'","text":"'.$textTL.'","9":"'.$mediaTL.'","media":"'.$mediaTL.'","10":"'.$creditTL.'","credit":"'.$creditTL.'","11":"'.$captionTL.'","caption":"'.$captionTL.'","12":"'.$idFromProject.'","idFromProject":"'.$idFromProject.'"',
               '}]}}{'

  
            );
        $replace = array(
            '"timeline":{"headline":"'.$headline.'","type":"default","text":"'.$text.'","startDate":"'.$startdate.'","date":[{',
            '"startDate":"'.$startDateTL.'","headline":"'.$headlineTL.'","text":"'.$textTL.'","asset":{"media":"'.$mediaTL.'","credit":"'.$creditTL.'","caption":"'.$captionTL.'"}}]}',
            '},'
            
            );
        
        
    }

    

   // disconnectDB($conexion); //desconectamos la base de datos

   // return $rawdata; //devolvemos el array
//}
        //global $headline;
        //echo 'This Headline: '.$headline;
        $myArray = getArraySQL($sql);
        //echo $sql['headline'];
        $value =  json_encode($myArray);
        //echo '<pre>';var_dump($value);echo '</pre>';
       
