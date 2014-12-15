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
	<title>Lead Panel | my App</title>
	<?php

		include("header.php");

	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		$themail = $row['email'];
		$username = str_replace('@thehangar.cr', '', $themail);

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
                                <img class="nav-user-photo" src="https://cm1.criticalmass.com/people/<?php echo $username; ?>/avatar/68.png?a=2991" alt="Jason's Photo" />
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
    <li class="active">
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
					User Profile
				</h1>
			</div><!-- /.page-header -->

			<div class="">
			<div id="user-profile-1" class="user-profile row">
				<div class="col-xs-12 col-sm-3 center">
					<div>
						<span class="profile-picture">
							<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" src="https://cm1.criticalmass.com/people/<?php echo $username; ?>/avatar/128.png?a=2991" style="display: block;"></img>
						</span>

						<div class="space-4"></div>

						<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
							<div class="inline position-relative">
								<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
									<i class="icon-circle light-green middle"></i>
									&nbsp;
									<span class="white"><?php echo $row['name'].' '.$row['lastname']; ?></span>
								</a>


							</div>
						</div>
					</div>

					<div class="space-6"></div>

					<div class="profile-contact-info">
						<div class="profile-contact-links align-left">
							<a class="btn btn-link" href="#">
								<i class="icon-envelope bigger-120 pink"></i>
								Send an email
							</a>
<!-- 
							<a class="btn btn-link" href="#">
								<i class="icon-globe bigger-125 blue"></i>
								www.alexdoe.com
							</a> -->
						</div>

						<div class="space-6"></div>

						<div class="profile-social-links center">
<!-- 							<a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
								<i class="middle icon-facebook-sign icon-2x blue"></i>
							</a>

							<a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
								<i class="middle icon-twitter-sign icon-2x light-blue"></i>
							</a>

							<a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
								<i class="middle icon-pinterest-sign icon-2x red"></i>
							</a> -->
						</div>
					</div>

					<div class="hr hr12 dotted"></div>

					<div class="clearfix">
						<div class="grid2">
<!-- 							<span class="bigger-175 blue">25</span>

							<br>
							Followers -->
						</div>

						<div class="grid2">
	<!-- 						<span class="bigger-175 blue">12</span>

							<br>
							Following -->
						</div>
					</div>

					<div class="hr hr16 dotted"></div>
				</div>

				<div class="col-xs-12 col-sm-9">
					<div class="center">
						<span class="btn btn-app btn-sm btn-light no-hover">
							<span class="line-height-1 bigger-170 blue"> 14 </span>

							<br>
							<span class="line-height-1 smaller-90"> Projects </span>
						</span>

						<span class="btn btn-app btn-sm btn-yellow no-hover">
							<span class="line-height-1 bigger-170"> 3 </span>

							<br>
							<span class="line-height-1 smaller-90"> Comments </span>
						</span>


					</div>

					<div class="space-12"></div>

					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name"> Username </div>

							<div class="profile-info-value">
								<span class="editable editable-click" id="username"><?php echo $row['username'] ?></span>
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> First Name </div>

							<div class="profile-info-value">
								<!-- <i class="icon-map-marker light-orange bigger-110"></i> -->
								<span class="editable editable-click" id="country"><?php echo $row['name'] ?></span>
								<!-- <span class="editable editable-click" id="city">Amsterdam</span> -->
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> Last Name </div>

							<div class="profile-info-value">
								<span class="editable editable-click" id="age"><?php echo $row['lastname'] ?></span>
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> Email </div>

							<div class="profile-info-value">
								<span class="editable editable-click" id="signup"><?php echo $row['email'] ?></span>
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> Department </div>

							<?php 



							 ?>

							<div class="profile-info-value">
								<span class="editable editable-click" id="about"><?php 	
								$department = $row['department'];

								switch ($department) {
								    case 0:
								        echo "Not Available";
								        break;
								    case 1:
								        echo "Administration";
								        break;
								    case 2:
								        echo "Technology";
								        break;
								} 
							?></span>
							</div>
						</div>
					</div>

					<div class="space-20"></div>

					<div class="widget-box transparent">
						<div class="widget-header widget-header-small">

						</div>



					<div class="hr hr2 hr-double"></div>

					<div class="space-6"></div>

				</div>
			</div>
		</div>

		</div>						
		<?php include("down.php");
		//make sure you close the check if their online
		}	?>
</body>
</html>
