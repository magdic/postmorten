<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

//Array to store validation errors
$errmsg_arr = array();
if (!isset($_SESSION)) {
session_start();

}

$pmuid = $_SESSION['uid'];
$result = mysql_query("SELECT * FROM projectsTB AS a, users AS b, joinedTB AS c WHERE a.idtimeLine = c.idProjectJO AND b.id = c.idUsernameJO AND b.id='$pmuid'");





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

?>


<!DOCTYPE html>
<html>
<head>
	<title>Timelines to Me | my App</title>

    <script src="//localhost:35729/livereload.js"></script>

    <!-- basic styles -->

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- fonts -->

    <link rel="stylesheet" href="../assets/css/ace-fonts.css" />

    <!-- ace styles -->

    <link rel="stylesheet" href="../assets/css/ace.min.css" />
    <link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

    <!-- overwrite -->

    <link rel="stylesheet" href="../assets/css/main.css"/>

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

   <script src="../assets/js/ace-extra.min.js"></script>
</head>
<body>
	<?php
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else if ($row['role'] != 3){
			echo "<center>You are not an <b>Lead User</b> site!</center>";
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");

			?>

            <div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="pm-panel.php" class="navbar-brand"></a><!-- /.brand -->
                </div><!-- /.navbar-header -->

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

                    <!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                            <button class="btn btn-success">
                                <i class="icon-signal"></i>
                            </button>

                            <button class="btn btn-info">
                                <i class="icon-pencil"></i>
                            </button>

                            <button class="btn btn-warning">
                                <i class="icon-group"></i>
                            </button>

                            <button class="btn btn-danger">
                                <i class="icon-cogs"></i>
                            </button>
                        </div>

                        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                            <span class="btn btn-success"></span>

                            <span class="btn btn-info"></span>

                            <span class="btn btn-warning"></span>

                            <span class="btn btn-danger"></span>
                        </div>
                    </div> --><!-- #sidebar-shortcuts -->

                    <ul class="nav nav-list">
                        <li>
                            <a href="pm-panel.php">
                                <i class="icon-dashboard"></i>
                                <span class="menu-text"> PM Dashboard </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="timelines-to-me.php">
                                <i class="icon-sitemap"></i>
                                <span class="menu-text"> Timelines assigned </span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="add-timeline.php">
                                <i class="icon-plus"></i>
                                <span class="menu-text"> Add timeline feedback </span>
                            </a>
                        </li> -->
                         <li>
                            <a href="add-users-to-project.php">
                                <i class="icon-plus"></i>
                                <span class="menu-text"> Add user </span>
                            </a>
                        </li>
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
                                <a href="pm-panel.php">Home</a>
                            </li>
                            <li>Dashboard</li>
                           <!--  <li class="active">Timelines assigned</li> -->
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
                                            PM Dashboard
                                            <small>
                                                <i class="icon-double-angle-right"></i>
                                               Timelines assigned
                                            </small>
                                        </h1>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">

                                            <div class="table-responsive">
                                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Project</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                <?php $query = mysql_query("SELECT * FROM projectsTB AS a, users AS b, joinedTB AS c WHERE a.idtimeLine = c.idProjectJO AND b.id = c.idUsernameJO AND b.id='$uid'") or die(mysql_error());
                                                while ($row = mysql_fetch_array($query)) {
                                                    $id = $row['idtimeLine']; ?>

                                                    <tr>
                                                        <td><?php echo $row['headlineP']; ?></td>
                                                        <td>
                                                            <a class="btn btn-xs btn-success" href="timelines/timeline.php?id=<?php echo $id?>">See Timeline <i class="icon-bar-chart bigger-120"></i></a>
                                                            <a class="btn btn-xs btn-info" href="add-timeline.php?id=<?php echo $id?>">See/add feedback <i class="icon-edit bigger-120"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /.table-responsive -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
            </div>
        </div>


        <script src='../assets/js/jquery-2.0.3.min.js'></script>
        <script src='../assets/js/jquery.mobile.custom.min.js'></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <script src="../assets/js/bootstrap-tag.min.js"></script>
        <script src="../assets/js/jquery.hotkeys.min.js"></script>
        <script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>

        <!-- ace scripts -->

        <script src="../assets/js/ace-elements.min.js"></script>
        <script src="../assets/js/ace.min.js"></script>

	<!-- <h1>PostMorten Timeline App</h1>
	<h2>Assign PM to Project</h2>
		<a href="pm-panel.php">PM Panel</a>

		<ul>
			<li><a href="">My Profile</a></li>
			<li><a href="timelines-to-me.php">Timelines Added to Me</a></li>
			<li><a href="">Hook User to Project</a></li>
			<li><a href="../../logout.php">Log Out</a></li>
		</ul>
		</form> -->








<?php

		//MAKE SURE YOU CLOSE THE CHECK IF THEIR ONLINE
		}

		?>
</body>
</html>
