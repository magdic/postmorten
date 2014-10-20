<?php 


		//allow sessions to be passed so we can see if the user is logged in
		session_start();

		//connect to the database so we can check, edit, or insert data to our users table
		include "../config/dbconfig.php";

		//include out functions file giving us access to the protect() function
		include "../config/functions.php";

		$idUser = protect($_POST['idUser']);

		$oldPass = protect($_POST['oldPassword']);
		$newPass = protect($_POST['newPassword']);
		$passAgain = protect($_POST['reNewPassword']);

		$decrypted = md5($oldPass);

		$checkOldPassword = mysql_query("SELECT * FROM users WHERE id = ".$idUser." ") or die(mysql_error());
		//split all fields fom the correct row into an associative array
		while($row = mysql_fetch_array($checkOldPassword)) {
			$checkedPass=$row['password'];
		}

		// echo '<p>Decrypted</p> = '.$decrypted.' Checked with  = '.$checkedPass;die();
		if (!$oldPass || !$newPass || !$passAgain) {
			$messageError = "Plase, fill all the fields.";
			displayError($messageError);exit();
		} else {
			if (strlen($newPass) > 32 || strlen($newPass) < 6) {
				// echo 'Fill all fields';die();
				$messageError = "Plase, your new pass should be at least 6 characters, maximum 32.";
				displayError($messageError);exit();
		} else {
			if ($newPass != $passAgain) {
				// echo 'New pass and pass again needs be equal.';die();
				$messageError = "New pass and pass again needs be equal.";
				displayError($messageError);exit();
			} else {
				if ($checkedPass != $decrypted) {
					// echo 'Check your Old Password.';die();
					$messageError = "Please, Check Your Old Password.";
					displayError($messageError);exit();
				} else {
					mysql_query('UPDATE users SET password = "'.md5($newPass).'" WHERE  password = "'.$decrypted.'" AND id="'.$idUser.'"');		
					$messageError = "Your password has been change.</br>
							If you want you can <a href=\"../logout.php\">Logout</a> in your account.
						";
					displayError($messageError);exit();			
					} 
				}
			}
		}

function displayError($messageError) {




		echo '
		<!DOCTYPE html>
<html  lang="en"><!--
  	 
  	88888888888 d8b                        888 d8b                888888   d8888b  
  	    888     Y8P                        888 Y8P                   88b d88P  Y88b 
  	    888                                888                       888 Y88b
  	    888     888 88888b d88b     d88b   888 888 88888b     d88b   888   Y888b
  	    888     888 888  888  88b d8P  Y8b 888 888 888  88b d8P  Y8b 888      Y88b
  	    888     888 888  888  888 88888888 888 888 888  888 88888888 888        888 
  	    888     888 888  888  888 Y8b      888 888 888  888 Y8b      88P Y88b  d88P 
  	    888     888 888  888  888   Y8888  888 888 888  888   Y8888  888   Y8888P
  	                                                                d88P            
  	                                                              d88P             
  	                                                            888P              
  	 -->
  <head>
    <title>Error | Postmorten App</title>
    <meta charset="utf-8">
    <meta name="description" content="TimelineJS example">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/ng-infinite-scroll.js"></script> -->

    <!-- HTML5 shim, for IE6-8 support of HTML elements--><!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<html>
<head>
	<title>Error | Postmorten</title> 
        <!-- basic styles -->

        <link href="../app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../app/assets/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="../app/assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../app/assets/css/ace.min.css" />
        <link rel="stylesheet" href="../app/assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../app/assets/css/ace-skins.min.css" />

        <!-- inline styles related to this page -->
        
        <link rel="stylesheet" href="../app/assets/css/main.css" />

        <!-- ace settings handler -->
        <script>
			function goBack() {
			    window.history.back()
			}
		</script>


</head>
<body>

	<div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check(\'navbar\' , \'fixed\')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">

                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->

                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">
                                        <i class="icon-cog"></i>
                                        Settings
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i>
                                        Profile
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="../../../logout.php">
                                        <i class="icon-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.ace-nav -->
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="icon-random"></i>
												Error
											</span>
											Keep calm, and go back and try again! 
										</h1>

										<hr>
										<h3 class="lighter smaller">
											
											'.$messageError.'
											<i class="icon-wrench icon-animated-wrench bigger-125"></i>
										</h3>

										<div class="space"></div>


										<hr>
										<div class="space"></div>

										<div class="center">
											<a  onclick="goBack()" class="btn btn-grey">
												<i class="icon-arrow-left"></i>
												Go Back
											</a>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
			

    
  </body>
</html>
';
}
