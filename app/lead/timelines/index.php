
<?php 

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";

?>

<!DOCTYPE html>
<html data-ng-app="myApp" lang="en"><!--
  	 
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
    <title>Timelines | Postmorten App</title>
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
    <?php

    include("header.php");

      $uid = $_SESSION['uid'];
    $res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
    //split all fields fom the correct row into an associative array
    $row = mysql_fetch_assoc($res);

    //if the login session does not exist therefore meaning the user is not logged in
    if(!$_SESSION['uid']){
      //display and error message
      include("../error-login.php");
    }else if ($row['role'] != 2){
			include("../error-not-lead.php");
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
                                <!-- <img class="nav-user-photo" src="../../assets/avatars/user.jpg" alt="Jason's Photo" /> -->
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



 <ul class="nav nav-list">
    <li>
        <a href="../lead-panel.php">
            <i class="icon-dashboard"></i>
            <span class="menu-text"> Lead Panel </span>
        </a>
    </li>
    <li>
        <a href="../lead-add-project.php">
            <i class="icon-save"></i>
            <span class="menu-text"> Create Project </span>
        </a>
    </li>
    <li>
        <a href="../add-pm-to-project.php">
            <i class="icon-group"></i>
            <span class="menu-text"> Add PM to project </span>
        </a>
    </li>
    <li class="active">
        <a href="../timelines">
            <i class="icon-eye-open"></i>
            <span class="menu-text"> Projects </span>
        </a>
    </li>
    <li>
        <a href="../../../logout.php">
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
      <div class="page-content"  >
<div ng-controller="customersCrtl">
<div class="container">
    <div class="row">
        <div class="col-md-2">Qty of Results:
            <select data-ng-model="entryLimit" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-md-3">Filter:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Search a timeline..." class="form-control" />
        </div>
        <div class="col-md-4">
            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total timeline projects</h5>
        </div>
    </br> 
    </br> 
    </br> 
    </br> 
    <div class="row">
        <div class="col-md-12" data-ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
            <th>Project Name&nbsp;<a ng-click="sort_by('headlineP');"><i class="icon-angle-up"></i><i class="icon-angle-down"></i></a></th>
            <th>Description/Date&nbsp;<a ng-click="sort_by('startDateP');"><i class="icon-angle-up"></i><i class="icon-angle-down"></i></a></th>
            <th>Options&nbsp;<a ng-click="sort_by('startDateP');"></i></a></th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.headlineP}}</td>
                    <td>{{data.textP}}&nbsp;/&nbsp;<b>{{data.startDateP}}</b></td>
                    <td><a href="timeline.php?id={{data.idtimeLine}}"><i class="icon-external-link bigger-130"></i></a> - <a href="edit.php?id={{data.idtimeLine}}"><i class="icon-pencil bigger-130"></i></a></td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="col-md-12" data-ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>Timeline not found</h4>
            </div>
        </div>
        <div class="col-md-12" data-ng-show="filteredItems > 0">    
            <div data-pagination="" data-page="currentPage" data-on-select-page="setPage(page)" data-boundary-links="true" data-total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" data-previous-text="&laquo;" data-next-text="&raquo;"></div>
            
            
        </div>
    </div>
</div>
</div>
</div>
  


      </div>

      <!-- END Timeline Embed-->
          <?php include("down.php");
    //make sure you close the check if their online
    } ?>
    <script src="js/angular.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script src="js/app.js"></script>    
  </body>
</html>