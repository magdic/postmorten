<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lead Change Password | Postmorten App</title>
	<?php

		include("header.php");

	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			include("error-login.php");
		}else if ($row['role'] != 2){
			include("error-not-lead.php");
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			?>
	 
<div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <!-- <img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" /> -->
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?php echo $row['name'].' '.$row['lastname']; ?>
                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="change-pass.php">
                                        <i class="icon-key"></i>
                                        Change Password
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
                                    <a href="../../logout.php">
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




<div class="main-container" id="main-container">
    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>



 <ul class="nav nav-list">
    <li>
        <a href="lead-panel.php">
            <i class="icon-dashboard"></i>
            <span class="menu-text"> Lead Panel </span>
        </a>
    </li>
    <li>
        <a href="lead-add-project.php">
            <i class="icon-save"></i>
            <span class="menu-text"> Create Project </span>
        </a>
    </li>
    <li>
        <a href="add-pm-to-project.php">
            <i class="icon-group"></i>
            <span class="menu-text"> Add PM to project </span>
        </a>
    </li>
    <li>
        <a href="./timelines">
            <i class="icon-eye-open"></i>
            <span class="menu-text"> Projects </span>
        </a>
    </li>
    <li class="active">
        <a href="">
            <i class="icon-key"></i>
            <span class="menu-text"> Change Pass </span>
        </a>
    </li>
    <li>
        <a href="../../logout.php">
            <i class="icon-mail-reply"></i>
            <span class="menu-text"> Log Out </span>
        </a>
    </li>
</ul><!-- /.nav-list -->
		<?php include("header-succes.php");	?>
		<div class="page-content">
			<div class="page-header">
				<h1>
					Lead Panel
				</h1>
			</div><!-- /.page-header -->

			 <form action="../../controllers/change-password.php" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="idUser" value="<?php echo $uid; ?>" readonly />
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Old Password: </label>
                        <div class="col-sm-8">
                            <input type="password"  name="oldPassword" placeholder="" class="col-xs-12 col-sm-8" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> New Password: </label>
                        <div class="col-sm-8">
                            <input type="password"  name="newPassword" placeholder=""  class="col-xs-12 col-sm-8" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Re-Entry new Password: </label>
                        <div class="col-sm-8">
                            <input type="password"  name="reNewPassword" placeholder="" class="col-xs-12 col-sm-8" />
                        </div>
                    </div>




                </fieldset>
                    <div class="form-actions center">
                        <input type="submit" name="submit" class="btn btn-sm btn-success btn-block" value="Change Password" />
                    </div>
            </form>



		</div>						
		<?php include("down.php");
		//make sure you close the check if their online
		}	?>
</body>
</html>
