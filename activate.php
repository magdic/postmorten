<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "config/functions.php";

?>
<html>
	<head>
		<title>Activation Page</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
		
		//echo md5('other');
		//get the code that is being checked and protect it before assigning it to a variable
		$code = protect($_GET['code']);
		
		//check if there was no code found
		if(!$code){
			//if not display error message
			echo "<center>Unfortunatly there was an error there!</center>";
		}else{
			//other wise continue the check
			
			//select all the rows where the accounts are not active
			$res = mysql_query("SELECT * FROM `users` AS `a`, `usersFromDB` AS `b` WHERE a.active = '0' AND a.email=b.email");
			
			//loop through this script for each row found not active
			while($row = mysql_fetch_assoc($res)){

				//echo $row['username'];die();
				//check if the code from the row in the database matches the one from the user
				if($code == md5($row['username']).$row['rtime']){
					//if it does then activate there account and display success message
					$res1 = mysql_query("UPDATE `users` SET `active` = '1', `name` = '".$row['nameFDB']."', `lastname` = '".$row['lastNameFDB']."', `role` = '".$row['position']."' WHERE `id` = '".$row['id']."'");
					echo "<center>You have successfully activated your account!</center>";
					// echo $row['username'];
					// echo $row['nameFDB'];
					// echo $row['lastNameFDB'];
					// echo $row['lastname'];
				}
			}
		}
		
		?>
		</div>
	</body>
</html>