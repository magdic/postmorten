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
	<title>Welcome PM User | my App</title>
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
			echo "<center>What are you doing here?</br>You are not an <b>PM User</b>!</center>";
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
                    <a href="#" class="navbar-brand"></a><!-- /.brand -->
                </div><!-- /.navbar-header -->

                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" />
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

                    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
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
                    </div><!-- #sidebar-shortcuts -->

                    <ul class="nav nav-list">
                        <li class="active">
                            <a href="#">
                                <i class="icon-user"></i>
                                <span class="menu-text"> My Profile </span>
                            </a>
                        </li>
                        <li>
                            <a href="timelines-to-me.php">
                                <i class="icon-sitemap"></i>
                                <span class="menu-text"> Timelines added to me </span>
                            </a>
                        </li>
                       <!--  <li>
                            <a href="add-timeline.php">
                                <i class="icon-plus"></i>
                                <span class="menu-text"> Add timeline feedback </span>
                            </a>
                        </li> -->
                         <li>
                            <a href="#">
                                <i class="icon-plus"></i>
                                <span class="menu-text"> Add user to project </span>
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
                                <a href="#">Home</a>
                            </li>
                            <li class="active">Dashboard</li>
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
                                                overview &amp; stats
                                            </small>
                                        </h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="widget-box transparent" id="recent-box">
                                                <div class="widget-header">
                                                    <h4 class="lighter smaller">
                                                        <i class="icon-rss orange"></i>
                                                        RECENT
                                                    </h4>

                                                    <div class="widget-toolbar no-border">
                                                        <ul class="nav nav-tabs" id="recent-tab">
                                                            <li class="active">
                                                                <a data-toggle="tab" href="#task-tab">Tasks</a>
                                                            </li>

                                                            <li>
                                                                <a data-toggle="tab" href="#member-tab">Members</a>
                                                            </li>

                                                            <li>
                                                                <a data-toggle="tab" href="#comment-tab">Comments</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main padding-4">
                                                        <div class="tab-content padding-8 overflow-visible">
                                                            <div id="task-tab" class="tab-pane active">
                                                                <h4 class="smaller lighter green">
                                                                    <i class="icon-list"></i>
                                                                    Sortable Lists
                                                                </h4>

                                                                <ul id="tasks" class="item-list">
                                                                    <li class="item-orange clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Answering customer questions</span>
                                                                        </label>

                                                                        <div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
                                                                            <span class="percent">42</span>%
                                                                        </div>
                                                                    </li>

                                                                    <li class="item-red clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Fixing bugs</span>
                                                                        </label>

                                                                        <div class="pull-right action-buttons">
                                                                            <a href="#" class="blue">
                                                                                <i class="icon-pencil bigger-130"></i>
                                                                            </a>

                                                                            <span class="vbar"></span>

                                                                            <a href="#" class="red">
                                                                                <i class="icon-trash bigger-130"></i>
                                                                            </a>

                                                                            <span class="vbar"></span>

                                                                            <a href="#" class="green">
                                                                                <i class="icon-flag bigger-130"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>

                                                                    <li class="item-default clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Adding new features</span>
                                                                        </label>

                                                                        <div class="inline pull-right position-relative dropdown-hover">
                                                                            <button class="btn btn-minier bigger btn-primary">
                                                                                <i class="icon-cog icon-only bigger-120"></i>
                                                                            </button>

                                                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-caret dropdown-close pull-right">
                                                                                <li>
                                                                                    <a href="#" class="tooltip-success" data-rel="tooltip" title="Mark&nbsp;as&nbsp;done">
                                                                                        <span class="green">
                                                                                            <i class="icon-ok bigger-110"></i>
                                                                                        </span>
                                                                                    </a>
                                                                                </li>

                                                                                <li>
                                                                                    <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                        <span class="red">
                                                                                            <i class="icon-trash bigger-110"></i>
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li class="item-blue clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Upgrading scripts used in template</span>
                                                                        </label>
                                                                    </li>

                                                                    <li class="item-grey clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Adding new skins</span>
                                                                        </label>
                                                                    </li>

                                                                    <li class="item-green clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Updating server software up</span>
                                                                        </label>
                                                                    </li>

                                                                    <li class="item-pink clearfix">
                                                                        <label class="inline">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"> Cleaning up</span>
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div id="member-tab" class="tab-pane">
                                                                <div class="clearfix">
                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Bob Doe's avatar" src="assets/avatars/user.jpg" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Bob Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">20 min</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-warning label-sm">pending</span>

                                                                                <div class="inline position-relative">
                                                                                    <button class="btn btn-minier bigger btn-yellow btn-no-border dropdown-toggle" data-toggle="dropdown">
                                                                                        <i class="icon-angle-down icon-only bigger-120"></i>
                                                                                    </button>

                                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                                        <li>
                                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
                                                                                                <span class="green">
                                                                                                    <i class="icon-ok bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
                                                                                                <span class="orange">
                                                                                                    <i class="icon-remove bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                                <span class="red">
                                                                                                    <i class="icon-trash bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Joe Doe's avatar" src="assets/avatars/avatar2.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Joe Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">1 hour</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-warning label-sm">pending</span>

                                                                                <div class="inline position-relative">
                                                                                    <button class="btn btn-minier bigger btn-yellow btn-no-border dropdown-toggle" data-toggle="dropdown">
                                                                                        <i class="icon-angle-down icon-only bigger-120"></i>
                                                                                    </button>

                                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                                        <li>
                                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
                                                                                                <span class="green">
                                                                                                    <i class="icon-ok bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
                                                                                                <span class="orange">
                                                                                                    <i class="icon-remove bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                                <span class="red">
                                                                                                    <i class="icon-trash bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Jim Doe's avatar" src="assets/avatars/avatar.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Jim Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">2 hour</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-warning label-sm">pending</span>

                                                                                <div class="inline position-relative">
                                                                                    <button class="btn btn-minier bigger btn-yellow btn-no-border dropdown-toggle" data-toggle="dropdown">
                                                                                        <i class="icon-angle-down icon-only bigger-120"></i>
                                                                                    </button>

                                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                                        <li>
                                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
                                                                                                <span class="green">
                                                                                                    <i class="icon-ok bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
                                                                                                <span class="orange">
                                                                                                    <i class="icon-remove bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                                <span class="red">
                                                                                                    <i class="icon-trash bigger-110"></i>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Alex Doe's avatar" src="assets/avatars/avatar5.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Alex Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">3 hour</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-danger label-sm">blocked</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Bob Doe's avatar" src="assets/avatars/avatar2.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Bob Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">6 hour</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-success label-sm arrowed-in">approved</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Susan's avatar" src="assets/avatars/avatar3.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Susan</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">yesterday</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-success label-sm arrowed-in">approved</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Phil Doe's avatar" src="assets/avatars/avatar4.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Phil Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">2 days ago</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-info label-sm arrowed-in arrowed-in-right">online</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv memberdiv">
                                                                        <div class="user">
                                                                            <img alt="Alexa Doe's avatar" src="assets/avatars/avatar1.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Alexa Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">3 days ago</span>
                                                                            </div>

                                                                            <div>
                                                                                <span class="label label-success label-sm arrowed-in">approved</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="center">
                                                                    <i class="icon-group icon-2x green"></i>

                                                                    &nbsp;
                                                                    <a href="#">
                                                                        See all members &nbsp;
                                                                        <i class="icon-arrow-right"></i>
                                                                    </a>
                                                                </div>

                                                                <div class="hr hr-double hr8"></div>
                                                            </div><!-- member-tab -->

                                                            <div id="comment-tab" class="tab-pane">
                                                                <div class="comments">
                                                                    <div class="itemdiv commentdiv">
                                                                        <div class="user">
                                                                            <img alt="Bob Doe's Avatar" src="assets/avatars/avatar.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Bob Doe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="green">6 min</span>
                                                                            </div>

                                                                            <div class="text">
                                                                                <i class="icon-quote-left"></i>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
                                                                            </div>
                                                                        </div>

                                                                        <div class="tools">
                                                                            <div class="inline position-relative">
                                                                                <button class="btn btn-minier bigger btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                                                    <i class="icon-angle-down icon-only bigger-120"></i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
                                                                                            <span class="green">
                                                                                                <i class="icon-ok bigger-110"></i>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
                                                                                            <span class="orange">
                                                                                                <i class="icon-remove bigger-110"></i>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                            <span class="red">
                                                                                                <i class="icon-trash bigger-110"></i>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv commentdiv">
                                                                        <div class="user">
                                                                            <img alt="Jennifer's Avatar" src="assets/avatars/avatar1.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Jennifer</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="blue">15 min</span>
                                                                            </div>

                                                                            <div class="text">
                                                                                <i class="icon-quote-left"></i>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
                                                                            </div>
                                                                        </div>

                                                                        <div class="tools">
                                                                            <div class="action-buttons bigger-125">
                                                                                <a href="#">
                                                                                    <i class="icon-pencil blue"></i>
                                                                                </a>

                                                                                <a href="#">
                                                                                    <i class="icon-trash red"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv commentdiv">
                                                                        <div class="user">
                                                                            <img alt="Joe's Avatar" src="assets/avatars/avatar2.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Joe</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="orange">22 min</span>
                                                                            </div>

                                                                            <div class="text">
                                                                                <i class="icon-quote-left"></i>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
                                                                            </div>
                                                                        </div>

                                                                        <div class="tools">
                                                                            <div class="action-buttons bigger-125">
                                                                                <a href="#">
                                                                                    <i class="icon-pencil blue"></i>
                                                                                </a>

                                                                                <a href="#">
                                                                                    <i class="icon-trash red"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="itemdiv commentdiv">
                                                                        <div class="user">
                                                                            <img alt="Rita's Avatar" src="assets/avatars/avatar3.png" />
                                                                        </div>

                                                                        <div class="body">
                                                                            <div class="name">
                                                                                <a href="#">Rita</a>
                                                                            </div>

                                                                            <div class="time">
                                                                                <i class="icon-time"></i>
                                                                                <span class="red">50 min</span>
                                                                            </div>

                                                                            <div class="text">
                                                                                <i class="icon-quote-left"></i>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
                                                                            </div>
                                                                        </div>

                                                                        <div class="tools">
                                                                            <div class="action-buttons bigger-125">
                                                                                <a href="#">
                                                                                    <i class="icon-pencil blue"></i>
                                                                                </a>

                                                                                <a href="#">
                                                                                    <i class="icon-trash red"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="hr hr8"></div>

                                                                <div class="center">
                                                                    <i class="icon-comments-alt icon-2x green"></i>

                                                                    &nbsp;
                                                                    <a href="#">
                                                                        See all comments &nbsp;
                                                                        <i class="icon-arrow-right"></i>
                                                                    </a>
                                                                </div>

                                                                <div class="hr hr-double hr8"></div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /widget-main -->
                                                </div><!-- /widget-body -->
                                            </div><!-- /widget-box -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
                                </div>
                            </div>
                        </div>
                     </div>
            </div>
        </div>


        <!-- <h1>Welcome PM User</h1>
        <ul>
            <li><a href="">My Profile</a></li>
            <li><a href="timelines-to-me.php">Timelines Added to Me</a></li>
            <li><a href="">Hook User to Project</a></li>
            <li><a href="../../logout.php">Log Out</a></li>
        </ul> -->




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


        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            jQuery(function($) {
                $('.easy-pie-chart.percentage').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                    var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                    var size = parseInt($(this).data('size')) || 50;
                    $(this).easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: parseInt(size/10),
                        animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                        size: size
                    });
                })

                $('.sparkline').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                    $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
                });




              var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
              var data = [
                { label: "social networks",  data: 38.7, color: "#68BC31"},
                { label: "search engines",  data: 24.5, color: "#2091CF"},
                { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
                { label: "direct traffic",  data: 18.6, color: "#DA5430"},
                { label: "other",  data: 10, color: "#FEE074"}
              ]
              function drawPieChart(placeholder, data, position) {
                  $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt:0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne",
                        labelBoxBorderColor: null,
                        margin:[-30,15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                 })
             }
             drawPieChart(placeholder, data);

             /**
             we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
             so that's not needed actually.
             */
             placeholder.data('chart', data);
             placeholder.data('draw', drawPieChart);



              var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
              var previousPoint = null;

              placeholder.on('plothover', function (event, pos, item) {
                if(item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + item.series['percent']+'%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

             });






                var d1 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.5) {
                    d1.push([i, Math.sin(i)]);
                }

                var d2 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.5) {
                    d2.push([i, Math.cos(i)]);
                }

                var d3 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.2) {
                    d3.push([i, Math.tan(i)]);
                }


                var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
                $.plot("#sales-charts", [
                    { label: "Domains", data: d1 },
                    { label: "Hosting", data: d2 },
                    { label: "Services", data: d3 }
                ], {
                    hoverable: true,
                    shadowSize: 0,
                    series: {
                        lines: { show: true },
                        points: { show: true }
                    },
                    xaxis: {
                        tickLength: 0
                    },
                    yaxis: {
                        ticks: 10,
                        min: -2,
                        max: 2,
                        tickDecimals: 3
                    },
                    grid: {
                        backgroundColor: { colors: [ "#fff", "#fff" ] },
                        borderWidth: 1,
                        borderColor:'#555'
                    }
                });


                $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('.tab-content')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    var w2 = $source.width();

                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }


                $('.dialogs,.comments').slimScroll({
                    height: '300px'
                });


                //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
                //so disable dragging when clicking on label
                var agent = navigator.userAgent.toLowerCase();
                if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
                  $('#tasks').on('touchstart', function(e){
                    var li = $(e.target).closest('#tasks li');
                    if(li.length == 0)return;
                    var label = li.find('label.inline').get(0);
                    if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
                });

                $('#tasks').sortable({
                    opacity:0.8,
                    revert:true,
                    forceHelperSize:true,
                    placeholder: 'draggable-placeholder',
                    forcePlaceholderSize:true,
                    tolerance:'pointer',
                    stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                        $(ui.item).css('z-index', 'auto');
                    }
                    }
                );
                $('#tasks').disableSelection();
                $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
                    if(this.checked) $(this).closest('li').addClass('selected');
                    else $(this).closest('li').removeClass('selected');
                });


            })
        </script>
		 <?php

		//make sure you close the check if their online
		}

		?>
    </body>
</html>
