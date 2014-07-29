<?php

//allow sessions to be passed so we can see if the user is logged in
//session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../config/functions.php";


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

//Sanitize the POST values
$idP= clean($_POST['idProjectJO']);
$idUser = clean($_POST['idUsernameJO']);

if ($idP == '' || $idUser == 0) {
	displayError();
	exit();
}

$resultf = mysql_query("SELECT * FROM joinedTB where idProjectJO='$idP' AND idUsernameJO='$idUser'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['idProjectJO'];
	$cccUSER=$rowf['idUsernameJO'];
	// if ($cccvvv=='' || $cccUSER=='0') {
	// 	echo 'stop';
	// }
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Project Allready Added';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	//header("location: login_ok.php");
	displayError();
	exit();
	}
	}
	}
mysql_query("INSERT INTO joinedTB (idProjectJO, idUsernameJO)
VALUES ('$idP','$idUser')");
header("location: ../app/lead/add-pm-to-project.php");


function displayError() {
		echo '
		<!DOCTYPE html>
<html  lang="en">
  <head>
    <title>Edit Timelines | Postmorten App</title>
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
											Inserting data
										</h1>

										<hr>
										<h3 class="lighter smaller">
											Keep calm, and go back
											
											and try again!
											<i class="icon-wrench icon-animated-wrench bigger-125"></i>
										</h3>

										<div class="space"></div>

										<div>
											<h4 class="lighter smaller">Reasons for this error:</h4>

											<ul class="list-unstyled spaced inline bigger-110 margin-15">
												<li>
													<i class="icon-hand-right blue"></i>
													You have inserted a data previously added.
												</li>

												<li>
													<i class="icon-hand-right blue"></i>
													You have left at least one of these fields empty: Project or User!
												</li>
											</ul>
										</div>

										<hr>
										<div class="space"></div>

										<div class="center">
											<a href="../app/lead/add-pm-to-project.php" class="btn btn-grey">
												<i class="icon-arrow-left"></i>
												Go Back
											</a>

											<a href="../app/lead/lead-panel.php" class="btn btn-primary">
												<i class="icon-dashboard"></i>
												Dashboard
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