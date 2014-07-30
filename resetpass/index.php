<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../config/functions.php";

//SET POST RESQUESTED NAMES
$idUser=$_REQUEST['user'];
$token=$_REQUEST['token'];

function time_elapsed_A($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );
        
    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;
        
    return join(' ', $ret);
    }
    

function time_elapsed_B($secs){
    $bit = array(
        ' year'        => $secs / 31556926 % 12,
        ' week'        => $secs / 604800 % 52,
        ' day'        => $secs / 86400 % 7,
        ' hour'        => $secs / 3600 % 24,
        ' minute'    => $secs / 60 % 60,
        ' second'    => $secs % 60
        );
        
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
        }
    array_splice($ret, count($ret)-1, 0, 'and');
    $ret[] = 'ago.';
    
    return join(' ', $ret);
    }
    
						$res = mysql_query("SELECT * FROM `users` WHERE `username` = '".$idUser."' AND `token` = '".$token."'");
						$num = mysql_num_rows($res);

						//split the row into an associative array
						$row = mysql_fetch_assoc($res);
    
    
$nowtime = time();
$oldtime = $row['psswrdTime'];

// echo 'This is the old time '.$oldtime.' + User'.$idUser;

$time_exp = time_elapsed_B($nowtime-$oldtime);

if (strpos($time_exp, 'hour') !== false) {

    echo '
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
                            <div class="center">
                                <h1>
                                    <span class="white">Your session has expired.</span>
                                    <span class="white">Remember that you have just one day to change your password, try again if you want change it.</span>
                                </h1>
                            </div>
                           <div class="center">
                              <a href="../forgot.php" class="btn btn-sm btn-danger">Reset Password</a>
                           
                              <a href="../index.php" class="btn btn-sm btn-danger">Login Page</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>  <!-- BODY EXPIRED -->
        <link rel="stylesheet" type="text/css" href="../style.css" />

        <link href="../app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../app/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="../app/assets/css/main.css">

        <!-- fonts -->

        <link rel="stylesheet" href="../app/assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../app/assets/css/ace.min.css" />
        <link rel="stylesheet" href="../app/assets/css/ace-rtl.min.css" />
	';exit();
} else {
	// echo "found it";
}

// echo "<span class=\"white\">time_elapsed_A: </span></br>".$nowtime."\n</br><span class=\"white\">time_elapsed_B: </span><h1>".$time_exp."</h1>\n";

?>
<html>
	<head>
		<title>Set a new password for your account | Postmorten App</title>
		<link rel="stylesheet" type="text/css" href="../style.css" />

        <link href="../app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../app/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="../app/assets/css/main.css">

        <!-- fonts -->

        <link rel="stylesheet" href="../app/assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../app/assets/css/ace.min.css" />
        <link rel="stylesheet" href="../app/assets/css/ace-rtl.min.css" />

         <!-- ace js -->
        <script src='../app/assets/js/jquery-2.0.3.min.js'></script>
        <script src="../app/assets/js/bootstrap.min.js"></script>
        <script src="../app/assets/js/typeahead-bs2.min.js"></script>

	</head>
    	<body class="login-layout">
		<?php

		//Check to see if the forms submitted
		if($_POST['submit']){
			//if it is continue checks

			//store the posted email to variable after protection
			$passw1 = protect($_POST['passw1']);
			$passw2 = protect($_POST['passw2']);

			//check if the email box was not filled in
			if(!$passw1 || !$passw2){
				//if it wasn't display error message

                echo    "<div class='row'>
                            <div class='col-sm-6 col-sm-offset-3'>
                               <div class='alert alert-warning'>
                                   <button type='button' class='close' data-dismiss='alert'>
                                       <i class='icon-remove'></i>
                                   </button>
                                   <strong>
                                        <i class='icon-remove'></i>

                                   </strong>
                                   You need to fill in your fields!
                                       <br />
                               </div>
                            </div>
                        </div>";
			} else {
				if($passw1 != $passw2) {

				echo    "<div class='row'>
                            <div class='col-sm-6 col-sm-offset-3'>
                               <div class='alert alert-warning'>
                                   <button type='button' class='close' data-dismiss='alert'>
                                       <i class='icon-remove'></i>
                                   </button>
                                   <strong>
                                        <i class='icon-remove'></i>

                                   </strong>
                                   The passwords must be equasl!
                                       <br />
                               </div>
                            </div>
                        </div>";

				} else {
					if (strlen($passw1) > 16 || strlen($passw2) < 5){
				echo    "<div class='row'>
                            <div class='col-sm-6 col-sm-offset-3'>
                               <div class='alert alert-warning'>
                                   <button type='button' class='close' data-dismiss='alert'>
                                       <i class='icon-remove'></i>
                                   </button>
                                   <strong>
                                        <i class='icon-remove'></i>

                                   </strong>
                                   The password must be longest that 5 and shortest than 16!
                                       <br />
                               </div>
                            </div>
                        </div>";
					} else {

						// echo '<h1>'.$passw1.'</h1> and '.$idUser;die();
						mysql_query('UPDATE users SET password = "'.md5($passw1).'", psswrdTime = 0  WHERE  username = "'.$idUser.'"');
				echo    "<div class='row'>
                            <div class='col-sm-6 col-sm-offset-3'>
                               <div class='alert alert-success'>
                                   <button type='button' class='close' data-dismiss='alert'>
                                       <i class='icon-remove'></i>
                                   </button>
                                   <strong>
                                        <i class='icon-remove'></i>

                                   </strong>
                                   You password has been changed now you can login !
                                       <br />
                               </div>
                            </div>
                        </div>";
					}
				}
			}
		}

		?>

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
                                <div id="forgot-box" class="forgot-box widget-box no-border visible">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="icon-key"></i>
                                                Reset Password
                                            </h4>
                                            <div class="space-6"></div>
                                            <p>
                                                Enter your desired new password
                                            </p>
                                            <form action="?user=<?php echo $idUser.'&&token='.$token.''; ?>" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="passw1" class="form-control" placeholder="Enter new password" />
                                                            <i class="icon-eye-close"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="passw2" class="form-control" placeholder="Confirm new password" />
                                                            <i class="icon-eye-close"></i>
                                                        </span>
                                                    </label>

                                                    <div class="clearfix">
                                                        <input name="submit" type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                                                           <!--  <i class="icon-lightbulb"></i>
                                                            Send Me! -->
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /widget-main -->
                                        <div class="toolbar center">
                                            <a href="index.php" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                Back to login
                                                <i class="icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div> <!-- forgot-box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>

<?php 






 ?>




