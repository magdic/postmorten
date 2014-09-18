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
	<title>Welcome Admin | Postmorten App</title>

	<?php include('header.php'); ?>
	<script src="../assets/charts/highcharts.js"></script>
	<script src="../assets/charts/exporting.js"></script>	

</head>
<body>

	<div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="" class="navbar-brand">
                        <!-- <small>
                            <i class="icon-leaf"></i>
                            Hangar
                        </small> -->
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->
	<?php
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else if ($row['role'] != 1){
			echo "<center>You are not an <b>admin</b> site!</center>";
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
		        <a href="">
		            <i class="icon-dashboard"></i>
		            <span class="menu-text"> Admin Panel </span>
		        </a>
		    </li>
		    <li >
		        <a href="users.php">
		            <i class="icon-group"></i>
		            <span class="menu-text"> Users </span>
		        </a>
		    </li>
		    <li>
		        <a href="#">
		            <i class="icon-save"></i>
		            <span class="menu-text"> Projects Comments </span>
		        </a>
		    </li>
<!-- 		    <li>
		        <a href="add-pm-to-project.php">
		            <i class="icon-group"></i>
		            <span class="menu-text"> Add PM to project </span>
		        </a>
		    </li> -->
<!-- 		    <li>
		        <a href="./timelines">
		            <i class="icon-eye-open"></i>
		            <span class="menu-text"> Projects </span>
		        </a>
		    </li> -->
		    <li>
		        <a href="../../logout.php">
		            <i class="icon-mail-reply"></i>
		            <span class="menu-text"> Log Out </span>
		        </a>
		    </li>
		</ul><!-- /.nav-list -->


<div class="sidebar-collapse" id="sidebar-collapse">
    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
</div>

<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
    </div>
    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="">Home</a>
                </li>
                <!-- <li class="active">Dashboard</li> -->
            </ul><!-- .breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                            <i class="icon-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- #nav-search -->
    	</div>	

		<div class="page-content">
			<div class="page-header">
				<h1>
					Admin Panel
				</h1>
			</div><!-- /.page-header -->


		<?php include("../graphs-charts/year-graph.php"); ?>		

		<?php include("../graphs-charts/months-graph.php"); ?>	

        <?php include("../graphs-charts/users-pie.php"); ?>  

		</div>	

        </div>
    </div>
</div>
                

<?php //make sure you close the check if their online
include("down.php");
	}
?>
</body>
</html>
