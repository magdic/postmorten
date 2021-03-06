 <?php 

// //connect to the database so we can check, edit, or insert data to our users table
// include('config/dbconfig.php');

// $result = mysql_query("SELECT * from users") or die('Could not query');

// if(mysql_num_rows($result)){
//     echo '{"timeline":{';

//     $first = true;
//     $row=mysql_fetch_assoc($result);
//     while($row=mysql_fetch_row($result)){
//         //  cast results to specific data types

//         if($first) {
//             $first = false;
//         } else {
//             echo ',';
//         }
//         echo json_encode($row);
//     }
//     echo ']}';
// } else {
//     echo '[]';
// } 



// // Returns: ["Apple","Banana","Pear"]
// echo json_encode(array("Apple", "Banana", "Pear"));
 
// // Returns: {"4":"four","8":"eight"}
// echo json_encode(array(4 => "four", 8 => "eight"));
 
// // Returns: {"apples":true,"bananas":null}
// echo json_encode(array("apples" => true, "bananas" => null));

/******************************************************
*******************************************************
*******************************************************
******************************************************/


class MySql_To_Json
{

    private $connection;
    public $errors = array();

    /**
     * @param $db_server
     * @param $db_username
     * @param $db_password
     * @param $db_name
     */

    public function __construct($db_server, $db_username, $db_password, $db_name)
    {
        $this->connection = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
    }

    /**
     * @param $query
     * @param bool $indented
     * @return bool|string
     */
    public function MySQLtoJSON($query, $indented = false)
    {
        $query = $this->connection->query($query) or die("Unable to execute the query");
        if (!$numFields = $query->columnCount()) {
            $this->errors[] = "Unable to get the number of fields";
            return false;
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);


        $json = json_encode($result);
        if ($indented == false)
            return $json;

        $result = '';
        $pos = 0;
        $previous = '';
        $outQuotes = true;
        for ($i = 0; $i <= strlen($json); $i++) {

            // Next char
            $char = substr($json, $i, 1);

            // Inside quote?
            if ($char == '"' && $previous != '\\') {
                $outQuotes = !$outQuotes;

                // End of element? New line and indent
            } elseif (($char == '}' || $char == ']') && $outQuotes) {
                $result .= "\n";
                $pos--;
                for ($j = 0; $j < $pos; $j++)
                    $result .= '    ';
            }

            // Add the character to the result string.
            $result .= $char;

            // Beginning of element? New line and indent
            if (($char == ',' || $char == '{' || $char == '[') && $outQuotes) {
                $result .= "\n";
                if ($char == '{' || $char == '[')
                    $pos++;

                for ($j = 0; $j < $pos; $j++)
                    $result .= '    ';
            }

            $previous = $char;
        }

        return $result;
    }

}

// Test


$db = new MySql_To_Json('localhost', 'root', 'root', 'loginTut');
$res = $db->MySQLtoJSON('SELECT * FROM timelines WHERE idFromProject = "1"', true);
var_dump($res);


$array = array(
    'headline' => 'Project Names',
    'type' => 'default',
    'text' => 'Lorem ipsum icatu anem',
    'startDate' => '2000,12,09',
    'date' => array(
        'startDate'=>'2001,01,03', 'headline'=>'Headline for Timeline', 'text'=>'Aguri manatoi'
    )
);

$json = json_encode($array);

print_r($json);






