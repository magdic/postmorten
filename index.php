
<?php
//allow sessions to be passed so we can see if the user is logged in
//asjdf;lasjdflaksjdf;lakdjfa;slkdjf;alksjf;lajf
session_start();


//connect to the database so we can check, edit, or insert data to our users table
include('config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "config/functions.php";

?>
<html>
	<head>
		<title>Login Page | My App</title>
        <script src="//localhost:35729/livereload.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css" />
        <!-- basic styles -->

        <link href="app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="app/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="app/assets/css/main.css">



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
		<?php

		//If the user has submitted the form
		if($_POST['submit']){
			//protect the posted value then store them to variables
			$username = protect($_POST['username']);
			$password = protect($_POST['password']);

			//Check if the username or password boxes were not filled in
			if(!$username || !$password){
				//if not display an error message
                echo    "<div class='row'>
                             <div class='col-sm-6 col-sm-offset-3'>
                                <div class='alert alert-danger'>
                                    <button type='button' class='close' data-dismiss='alert'>
                                        <i class='icon-remove'></i>
                                    </button>
                                    <strong>
                                         <i class='icon-ban-circle'></i>

                                    </strong>
                                        You need to fill in a <b>Username</b> and a <b>Password</b>!
                                        <br />
                                </div>
                             </div>
                        </div>";
			}else{
				//if the were continue checking

				//select all rows from the table where the username matches the one entered by the user
				$res = mysql_query("SELECT * FROM `users` WHERE `username` = '".$username."'");
				$num = mysql_num_rows($res);

				//check if there was not a match
				if($num == 0){
					//if not display an error message

                    echo "<div class='row'>
                             <div class='col-sm-6 col-sm-offset-3'>
                                <div class='alert alert-danger'>
                                    <button type='button' class='close' data-dismiss='alert'>
                                        <i class='icon-remove'></i>
                                    </button>
                                    <strong>
                                         <i class='icon-ban-circle'></i>

                                    </strong>
                                        The <b>Username</b> you supplied does not exist!
                                        <br />
                                </div>
                             </div>
                        </div>";
				}else{
					//if there was a match continue checking

					//select all rows where the username and password match the ones submitted by the user
					$res = mysql_query("SELECT * FROM `users` WHERE `username` = '".$username."' AND `password` = '".md5($password)."'");
					$num = mysql_num_rows($res);

					//check if there was not a match
					if($num == 0){
						//if not display error message

                        echo "<div class='row'>
                                 <div class='col-sm-6 col-sm-offset-3'>
                                    <div class='alert alert-danger'>
                                        <button type='button' class='close' data-dismiss='alert'>
                                            <i class='icon-remove'></i>
                                        </button>
                                        <strong>
                                             <i class='icon-ban-circle'></i>

                                        </strong>
                                            The <b>Password</b> you supplied does not match the one for that username!
                                            <br />
                                    </div>
                                 </div>
                            </div>";
					}else{
						//if there was continue checking

						//split all fields fom the correct row into an associative array
						$row = mysql_fetch_assoc($res);

						//check to see if the user has not activated their account yet
						if($row['active'] != 1){
							//if not display error message

                            echo "<div class='row'>
                                     <div class='col-sm-6 col-sm-offset-3'>
                                        <div class='alert alert-danger'>
                                            <button type='button' class='close' data-dismiss='alert'>
                                                <i class='icon-remove'></i>
                                            </button>
                                            <strong>
                                                 <i class='icon-ban-circle'></i>

                                            </strong>
                                                You have not yet <b>Activated</b> your account!
                                                <br />
                                        </div>
                                     </div>
                                </div>";
						}else{
							//if they have log them in
							$_SESSION['uid'] = $row['id'];
							//set the login session storing there id - we use this to see if they are logged in or not
							if ($_SESSION['uid'] = $row['id'] && $row['role'] == 1){
									$_SESSION['uid'] = $row['id'];
							//if($row['role'] == 1) {
							//Redirect to the user page
								//update the online field to 50 seconds into the future
							$time = date('U')+50;
							mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
							echo '<script>window.location.href="app/admin/"</script>';

						} else if ($_SESSION['uid'] = $row['id'] && $row['role'] == 2) {
							$_SESSION['uid'] = $row['id'];
							//update the online field to 50 seconds into the future
							$time = date('U')+50;
							mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
							echo '<script>window.location.href="app/lead/lead-panel.php"</script>';
						}
						else {
							$_SESSION['uid'] = $row['id'];
							//update the online field to 50 seconds into the future
							$time = date('U')+50;
							mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
							echo '<script>window.location.href="app/pm/pm-panel.php"</script>';
						}

							//update the online field to 50 seconds into the future
							$time = date('U')+50;
							mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");

							//redirect them to the usersonline page
							header('Location: usersOnline.php');
						}
					}
				}
			}
		}

		?>
    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <span class="white">PostMorten</span>
                                </h1>
                                <h4 class="form-logo centered"></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="icon-coffee green"></i>
                                                Please Enter Your Information
                                            </h4>
                                            <div class="space-6"></div>
                                                <form action="index.php" method="post">
                                                    <fieldset>
                                                        <label class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" name="username" class="form-control" placeholder="Username" />
                                                                <i class="icon-user"></i>
                                                            </span>
                                                        </label>

                                                        <label class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="password" name="password" class="form-control" placeholder="Password" />
                                                                <i class="icon-lock"></i>
                                                            </span>
                                                        </label>

                                                        <div class="space"></div>

                                                        <div class="clearfix">
                                                            <label class="inline">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"> Remember Me</span>
                                                            </label>

                                                            <input name="submit" type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                                <i class="icon-key"></i>
                                                              <!--   Login -->
                                                        </div>

                                                        <div class="space-4"></div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div><!-- /widget-main -->

                                        <div class="toolbar clearfix">
                                            <div>
                                                <a href="forgot.php" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
                                                    <i class="icon-arrow-left"></i>
                                                    I forgot my password
                                                </a>
                                            </div>

                                            <div>
                                                <a href="register.php" onclick="show_box('signup-box'); return false;" class="user-signup-link">
                                                    I want to register
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->

                               <!--  <?php
                                //include('forgot.php');
                                ?> -->


                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
	</body>
</html>

