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
	<title>Lead Add PM to Project | my App</title>
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
		}else if ($row['role'] != 2){
			echo "<center>You are not an <b>Lead User</b> site!</center>";
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			
			?>
	<h1>PostMorten Timeline App</h1>
	<h2>Assign PM to Project</h2>
		<a href="lead-panel.php">Lead Panel</a>

		<form action="../../controllers/hook-pm-to-project.php" method="post">
		<p>Select the Project: 
		<?php
			$result = mysql_query("SELECT * FROM projectTB");
		?>
		<select name="idProjectJO">
			<?php
				$i=0;
				while($row = mysql_fetch_array($result)) {
			?>
		<option value="<?=$row["idP"];?>"><?=$row["projectname"];?></option>
			<?php
				$i++;
				}
			?>
		</select></p>
		<p>Select Project Manager: 
		<?php
			$result = mysql_query("SELECT * FROM users");
		?>
		<select name="idUsernameJO">
			<?php
				$i=0;
				while($row = mysql_fetch_array($result)) {
			?>
		<option value="<?=$row["id"];?>"><?=$row["name"];echo ' '.$row['lastname'];?></option>
			<?php
				$i++;
				}
			?>
		</select></p>
	
		<p><input type="submit" name="submit" value="Assign"></input></p>
		</form>


		<!-- Table -->
        <table class="table">
          <thead>
            <tr>
              <th>Project</th>
              <th>PM User</th>
            </tr>
          </thead>
          <tbody>
           
			<?php $query = mysql_query("SELECT * FROM projectTB AS a, users AS b, joinedTB AS c WHERE a.idP = c.idProjectJO AND b.id = c.idUsernameJO") or die(mysql_error());
            	while ($row = mysql_fetch_array($query)) {
            		$id = $row['idP']; ?>

            <tr>
                <td><?php echo $row['projectname']; ?></td>
                <td><?php echo $row['name']; echo ' '.$row['lastname'];  ?></td>
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
