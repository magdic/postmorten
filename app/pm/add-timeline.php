<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

$idProject=$_REQUEST['id'];
$result = mysql_query("SELECT * FROM timeProject where idtimeLine='$idProject'");

while($row = mysql_fetch_array($result))
  {
	$idproject=$row['idtimeLine'];
	$prjctName=$row['headlineP'];
	$prjctType=$row['typeP'];
	$prjctText=$row['textP'];
	$prjctStartDate=$row['startDateP'];
}


//Array to store validation errors
$errmsg_arr = array();
if (!isset($_SESSION)) {
session_start();

}


 
//Validacion de bandera de error
$errflag = false;
//Funcion para recibir valores del form. Previene SQL injection
function clean($str)
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc())
			{
			$str = stripslashes($str);
			}
		return mysql_real_escape_string($str);
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Adding Timelines | my App</title>
</head>
<body>
	<?php
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else if ($row['role'] != 3){
			echo "<center>You are not an <b>PM User</b> site!</center>";
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			
			?>
	<h1>Adding Timeline</h1>
		<a href="pm-panel.php">PM Panel</a>
		<h3>Your project is: <?php echo $prjctName; ?> </h3>
		<p> <?php echo $prjctText; ?> </br> <?php echo $prjctStartDate; ?> </p>	
		<form action="../../controllers/addtimeline.php" method="post">
		<input type="hidden" id="idFromProject" name="idFromProject" value="<?php echo $idproject; ?>" readonly></input>
		<p>Timeline Start Date:<input type="text" placeholder="format yyyy,mm,dd" id="startDate" name="startDate"></input></p>
		<p>Headline:<input type="text" name="headline" id="headline" placeholder="Headline for the timeline"></input></p>
		<p>Text: <input type="text" placeholder="Reference Text" id="text" name="text"></input></p>
		<p>Media URL:<input type="text" placeholder="Media Url" id="media" name="media"></input></p>
		<p>Media Credit:<input type="text" placeholder="Credit" id="credit" name="credit"></input></p>
		<p>Media Caption:<input type="text" placeholder="Caption" id="caption" name="caption"></input></p>
		<p><input type="submit" name="submit" value="Add Timeline"></input></p>
		</form>


<?php
		
		//make sure you close the check if their online
		}
		
		?>
</body>
</html>
