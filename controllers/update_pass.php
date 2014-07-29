<?php 


		//allow sessions to be passed so we can see if the user is logged in
		session_start();

		//connect to the database so we can check, edit, or insert data to our users table
		include "../config/dbconfig.php";

		//include out functions file giving us access to the protect() function
		include "../config/functions.php";

		$passw1 = protect($_POST['passw1']);


		mysql_query('UPDATE users SET password = "'.$passw1.'" WHERE  username = "luisc"');