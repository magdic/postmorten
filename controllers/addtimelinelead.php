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
$idFromProject= clean($_POST['idFromProject']);
$startDate = clean($_POST['startDate']);
$headline = clean($_POST['headline']);
$text = clean($_POST['text']);
$media = clean($_POST['media']);
$credit = clean($_POST['credit']);
$caption = clean($_POST['caption']);

$id = time() + (7 * 24 * 60 * 60);
$idEncryped = md5($id);
//echo md5($id);die();
//echo 'Project Name: '.$projectname;die();

$resultf = mysql_query("SELECT * FROM timelines where startDate='$startDate' AND headline='$headline' AND media='$media' AND caption='$caption' AND credit='$credit' AND idFromProject='$idFromProject'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['idtimelines'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Timeline Allready Added';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	//header("location: login_ok.php");
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
													Give us more info on how this specific error occurred!
												</li>
											</ul>
										</div>

										<hr>
										<div class="space"></div>

										<div class="center">
											<a href="../app/lead/timelines/edit.php?id='.$idFromProject.'" class="btn btn-grey">
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



	
	exit();
	}
	}
	}
mysql_query("INSERT INTO timelines (startDate, headline, text, media, credit, caption, idFromProject)
VALUES ('$startDate','$headline','$text','$media', '$credit', '$caption', '$idFromProject')");
header("location: ../app/lead/timelines/edit.php?id=$idFromProject");