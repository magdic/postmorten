<?php


$projectname="Tasks";
$projectversion = "v0.0.3";

$LANG=NULL;
require('language.en.php');
//include_once('action.php');
//require('language.en.php');
global $idproject;

$idP=$_REQUEST['id'];
setcookie("TestCookie", $idP, time()+120);
//$_session['$filename'] = $idP;
//echo '<h2>'.$_COOKIE["TestCookie"].'</h2>';die();
$extension = "json";

echo '<h1>' .$string. '</h1>';

$namedJson = "$id.$extension";

$file='json_files/'.$_COOKIE["TestCookie"].'.'.$extension;

//echo $file;die();


$jsonfile = file_get_contents($file);
$json_b = json_decode($jsonfile, true);
$json_a = $json_b["timeline"]["date"];
//print_r($json_a);die();


$closed=0;
$havetasks = 0;
error_reporting(0);


function showinputform($actionpage) {
    global $LANG;
    global $idproject;
    global $prjctName;
    global $prjctRef;
    global $prjctStartDate;
    $vandaag=date('m-d-Y');
    
    echo "<form name=\"edit\" action=\"action.php\" method=\"GET\">";
    echo "<p>Project ID: <input name=\"idProject\" size=40 type=\"text\" value=\"$idproject\" readonly></input></p>";
    echo "<p>Project Name: <input name=\"projectname\" size=40 type=\"text\" value=\"$prjctName\" readonly></input></p>";
    echo "<p>Reference Text: <input name=\"projectref\" size=40 type=\"text\" value=\"$prjctRef\" readonly></input></p>";
    echo "<p>Start Date: <input name=\"projectstartdate\" size=40 type=\"text\" value=\"$prjctStartDate\" readonly></input></p>";
    echo "<p>Timeline Date: <input name=\"task\" size=40 type=\"text\" placeholder=\"Date format: yyyy,mm,dd\" ></input></p>";
    echo "<p>Headline: <input name=\"prio\" type=\"text\" placeholder=\"Headline\"></input>\n</p>";
    echo "<p>Text: <input name=\"duedate\" type=\"text\" placeholder=\"Text\"></input>\n</p>";
    echo "<p>Media: <input name=\"media\" type=\"text\" placeholder=\"Media url\"></input>\n</p>";
    echo "<p>Credit: <input name=\"credit\" type=\"text\" placeholder=\"Credit Media\"></input>\n</p>";
    echo "<p>Caption: <input name=\"caption\" type=\"text\" placeholder=\"Media Caption\"></input>\n</p>";
    echo "<input type=\"hidden\" name=\"action\" value=\"add\"></input>";
    echo "<input name=\"dateadded\" type=\"hidden\" value=\"${vandaag}\"></input>\n";
    echo "<input type=\"submit\" name=\"submit\" value=\"".$LANG["addtask"]."\"></input>";
    echo "</form>";
}



function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ((array) $arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}

# via http://richardathome.wordpress.com/2006/03/28/php-function-to-return-the-number-of-days-between-two-dates/
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}



function listtasks($json_a,$taskstatus,$outputformat) {
    global $LANG;
    $vandaag=date('d-m-Y');
    $havetasks = NULL;
    
   // array_sort_by_column($json_a, 'priority');

        echo "<table class=\"sortable striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Timeline Date</th>";
        echo "<th>Headline</th>";
        echo "<th>Text</th>";
        echo "<th>Options</th>";
        //echo "<th> </th>";
        echo "</tr>";
        echo "</thead>";
     
       
    if(is_array($json_a)) {   
     
        $tasknumber=1;
        $havetasks=NULL;

        
            for($i = 0; $i < count($json_a); ++$i) {
        

            

            echo "<tr>";
                    
            echo "<td>".$json_a[$i]['startDate']."</td>";
            echo "<td>".$json_a[$i]['headline']."</td>";
            echo "<td>".$json_a[$i]['text']."</td>";
            //echo "<td></td>";
            echo "<td><a href=\"action.php?id=" .$i. "&action=edit\">Actions</a></td>";
            echo "</tr>";
            
            }


            
            foreach ($json_a as $item => $task) {   
        }
       
    }


    
    echo "</table>";


}

function redirect($page = "./") {
    echo "<script type=\"text/javascript\">";
    echo "window.location = \"$page\" ";
    echo "</script>";
}


?>