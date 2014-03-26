<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include "config/dbconfig.php";

//include out functions file giving us access to the protect() function
include "config/functions.php";

?>
<html>
	<head>
		<title>Register on this Page | My App</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php 
			if($_GET['message'] == 'edeb734ec075b20cd9e995a05888270e'){
			echo '<center>Revisar email</center>';
			}
			if($_GET['message'] == 'a23e3efffdd987d1ef098e1d25199b38'){
			echo '<center>The <b>E-mail</b> address you supplied is already taken</center>';
			}
			if($_GET['message'] == '903ad7fca286e13199c0aedb9c5f4081'){
			echo '<center>You are <b>NOT member</b> of our company, you must have a company email like that name@thehang.net or name@soup.com!!</center>';
			}
			if($_GET['message'] == '288a62414db78c24149f396d8e4d6bc2'){
			echo '<center>The <b>Password</b> you supplied did not math the confirmation password!</center>';
			}
			if($_GET['message'] == '08bfefacdbd9b8dc8d8f3f2cba0645e3'){
			echo '<center>You need to fill in all of the required filds!</center>';
			}
			if($_GET['message'] == '6c864db20a09afec2e00ce46feeca264'){
			echo '<center>Your <b>Username</b> must be between 3 and 32 characters long!</center>';
			}
			if($_GET['message'] == 'b93ba93cb03d581227432da187c629c3'){
			echo '<center>The <b>Username</b> you have chosen is already taken!</center>';
			}
			if($_GET['message'] == 'f601b5d64fec441496b4f4899cd5aba4'){
			echo '<center>The <b>password</b> must be between 5 and 32 characters long!</center>';
			}			
			// $msg=$_GET['message'];
			// echo '<center>'.$msg.'</center>';			
		?>
		<div id="border">
			<form action="controllers/regAction.php" method="post">
				<table cellpadding="2" cellspacing="0" border="0">
					<tr>
						<td>Username: </td>
						<td><input type="text" name="username" /></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td>Confirm Password: </td>
						<td><input type="password" name="passconf" /></td>
					</tr>
					<tr>
						<td>Email: </td>
						<td><input type="text" name="email" size="25"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="submit" value="Register" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="./">Login</a> | <a href="forgot.php">Forgot Pass</a></a></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>