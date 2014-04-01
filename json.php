<?php
//CONNECT TO THE DATABASE SO WE CAN CHECK, EDIT, OR INSERT DATA TO OUR USERS TABLE
include('config/dbconfig.php');
//INCLUDE OUT FUNCTIONS FILE GIVING US ACCESS TO THE PROTECT() FUNCTION MADE EARLIER
include "config/functions.php";
//THE QUERY FOR THE PROJECT
$idProject=$_REQUEST['id'];
$sql2 = "SELECT * FROM timeProject AS a, timelines AS b WHERE b.idFromProject = a.idtimeLine AND b.idFromProject=$idProject"; 


    if(!$result = mysql_query($sql2)) die("ERROR"); //WITHOU CONNECTION CANCEL THE FILE


    $rawdata = array(); //ARRAY FOR THE DATA

    //INITIALIZING THE INDEX
    $i=0;

    while($row = mysql_fetch_array($result))
    {       
         $rawdata[$i] = $row;
            $i++;//THE INDEX OF THE ARRAY

        if($i==1){  //FOR THE FIRST INSTANCE OF THE ARRAY DISLPLAY THE PROJECT INFO
            echo '{"timeline":{
                "headline":"'.$row['headlineP'].'",
                "type":"'.$row['typeP'].'",
                "text":"'.$row['textP'].'",
                "startDate":"'.$row['startDateP'].'","date":[';
        }

        $array = array( //PRINT EACH TIMELIME ADDED
                'startDate'=>$row['startDate'], 
                'headline'=>$row['headline'], 
                'text'=>$row['text'], 
                'asset'=>array(
                'media'=>$row['media'],
                'credit'=>$row['credit'],
                'caption'=>$row['caption']
            )
        );

        if($i!=1){ //SEPARATOR FOR THE TIMELINES
            echo ',';
        }

        //REPLACE CHARACTERES FOR THE GOOD JSON SCHEMA
        $print = json_encode($array);
        $search = array("{\"date\"","}}","\/\/");
        $replace = array('"date"','}}','//');
        echo str_replace($search, $replace, $print);        
    } 
    echo ']}}'; //CLOSE THE JSON FILE, WITH TIMELINEJS FORMAT

       
