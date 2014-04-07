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
		<title>Login with Users Online Tutorial</title>
        <script src="//localhost:35729/livereload.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css" />

         <!-- basic styles -->

        <link href="app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="app/assets/css/font-awesome.min.css" />



        <!-- fonts -->

        <link rel="stylesheet" href="app/assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="app/assets/css/ace.min.css" />
        <link rel="stylesheet" href="app/assets/css/ace-rtl.min.css" />

        <!-- ace js -->
        <script src='app/assets/js/jquery-2.0.3.min.js'></script>
        <script src="app/assets/js/bootstrap.min.js"></script>
        <script src="app/assets/js/typeahead-bs2.min.js"></script>
	</head>
	<body>
		<!-- <center><a href="./">Index</a></center> -->
		<?php

		//check if the login session does no exist
		if(!$_SESSION['uid']){
			//if it doesn't display an error message
			/*echo "<center>You need to be logged in to log out!</center>";*/
            echo "<div class='row'>
                     <div class='col-sm-4 col-sm-offset-4'>
                        <div class='alert alert-block alert-warning'>
                            <p>
                                <strong>
                                    <i class='icon-ok'></i>
                                </strong>
                                    You need to be logged in to log out!
                            </p>
                            <p>
                                <a href='./' class='btn btn-sm btn-warning btn-block'>Go to Index</a>
                            </p>
                        </div>
                    </div>
                </div>";
		}else{
			//if it does continue checking

			//update to set this users online field to the current time
			mysql_query("UPDATE `users` SET `online` = '".date('U')."' WHERE `id` = '".$_SESSION['uid']."'");

			//destroy all sessions canceling the login session
			session_destroy();

			//display success message
			/*echo "<center>You have successfully logged out!</center>";*/
            echo            "<div class='row'>
                                 <div class='col-sm-4 col-sm-offset-4'>
                                    <div class='alert alert-block alert-success'>
                                        <p>
                                            <strong>
                                                <i class='icon-ok'></i>
                                            </strong>
                                                You have successfully logged out!
                                        </p>
                                        <p>
                                            <a href='./' class='btn btn-sm btn-success btn-block'>Go to Index</a>
                                        </p>
                                    </div>
                                </div>
                            </div>";
		}

		?>
	</body>
</html>
