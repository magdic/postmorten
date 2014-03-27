<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

//Array to store validation errors
$errmsg_arr = array();
if (!isset($_SESSION)) {
session_start();

}

$pmuid = $_SESSION['uid'];
$result = mysql_query("SELECT * FROM projectTB AS a, users AS b, joinedTB AS c WHERE a.idP = c.idProjectJO AND b.id = c.idUsernameJO AND b.id='$pmuid'");




 
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
	<title>Timelines to Me | my App</title>
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
			echo "<center>You are not an <b>Lead User</b> site!</center>";
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			
			?>
	<h1>PostMorten Timeline App</h1>
	<h2>Assign PM to Project</h2>
		<a href="pm-panel.php">PM Panel</a>

		<ul>
			<li><a href="">My Profile</a></li>
			<li><a href="timelines-to-me.php">Timelines Added to Me</a></li>
			<li><a href="">Hook User to Project</a></li>
			<li><a href="../../logout.php">Log Out</a></li>
		</ul>
		</form>


		<!-- Table -->
        <table class="table">
          <thead>
            <tr>
              <th>Project</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           
			<?php $query = mysql_query("SELECT * FROM projectTB AS a, users AS b, joinedTB AS c WHERE a.idP = c.idProjectJO AND b.id = c.idUsernameJO AND b.id='$uid'") or die(mysql_error());
            	while ($row = mysql_fetch_array($query)) {
            		$id = $row['idP']; ?>

            <tr>
                <td><?php echo $row['projectname']; ?></td>
                <td><a href="<?php echo 'postmorten?id='.$id?>">Edit</a></td>
            </tr>
			<?php } ?>

          </tbody>
        </table>


<?php
		
		//make sure you close the check if their online
		}
		
		?>
</body>
</html>
