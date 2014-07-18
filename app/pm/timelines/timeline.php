
<?php

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";


//SET JSON NAME TO CALL TIMELINE
$idProject=$_REQUEST['id'];
$json_id = $idProject;
?>

<!DOCTYPE html>
<html lang="en"><!--

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
    <title>Timeline JS Example</title>
    <meta charset="utf-8">
    <meta name="description" content="TimelineJS example">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Style-->
    <style>
      html, body {
       height:100%;
       padding: 0px;
       margin: 0px;
      }
      #demo {width: 100%;height: 600px;}

    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML elements--><!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
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
    }else {
      //otherwise continue the page

      //this is out update script which should be used in each page to update the users online time
      $time = date('U')+50;
      $update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
      ?>
        <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                               <!--  <img class="nav-user-photo" src="../../assets/avatars/user.jpg" alt="Jason's Photo" /> -->
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




<div class="main-container" id="main-container">
    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>

               <!--  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
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
        <a href="../pm-panel.php">
            <i class="icon-dashboard"></i>
            <span class="menu-text"> PM Dashboard </span>
        </a>
    </li>
    <li>
        <a href="../timelines-to-me.php">
            <i class="icon-sitemap"></i>
            <span class="menu-text"> Timelines Assigned </span>
        </a>

            <ul style="display: block;" class="submenu">
                <li class="active">
                    <a href="#">
                        <i class="icon-plus"></i>
                        <span class="menu-text"> Timeline </span>
                    </a>
                </li>
            </ul>
    </li>
    <li>
        <a href="../add-users-to-project.php">
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

<?php include("header-succes.php"); ?>
      <!-- BEGIN Timeline Embed -->
     <!--  <div><h1>Timeline App</h1>
        <a href="./?id=<?php echo $idProject;?>">Back</a>
      </div> -->
      <div class="page-content">
          <div class="page-header">
            <h1>Time Line</h1>
        </div><!-- /.page-header -->
          <div id="demo">
              <div id="timeline-embed"></div>
          </div>
      </div>
      <script type="text/javascript">
        var timeline_config = {
         width: "100%",
         height: "80%",
         source: "../../../json.php?id=<?php echo $json_id;?>"
        }
      </script>
      <script type="text/javascript" src="build/js/storyjs-embed.js"></script>
      <!-- END Timeline Embed-->
          <?php include("down.php");
    //make sure you close the check if their online
    } ?>
  </body>
</html>
