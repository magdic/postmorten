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
<html lang="en" ng-app="demo"> <!-- CALLING ANGULAR APP -->
<head>
	<title>Adding PM to Project | my App</title>

	<?php

		include("header.php");
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else if ($row['role'] != 2){
			echo "<center>You are not an <b>Lead User</b> site!</center>";
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
    <li class="active">
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


		<?php include("header-succes.php"); ?>


		<div class="page-content">
			<div class="page-header">
				<h1>
					Assign PM User to Project
				</h1>
			</div><!-- /.page-header -->

 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-sanitize.js"></script>
  <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css"> -->

  <!-- ui-select files -->
  <script src="select.js"></script>
  <link rel="stylesheet" href="select.css">

  <!--  IT'S THE SAME THAT YOU CALL AN EXTERNAL SCRIPT <script src="demo.js"></script> -->
   <?php include("../../controllers/demojs.php"); ?>

  <!-- Select2 theme -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">

  <!--
    Selectize theme
    Less versions are available at https://github.com/brianreavis/selectize.js/tree/master/dist/less
  -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css">


		<form action="../../controllers/hook-pm-to-project.php" method="post" ng-controller="DemoCtrl">
       <!--  ANGULAR FORM WAY TO SEARCH AND SELECT PROJECTS AND USERS-->
       <div class="form-group">
        <div class="col-sm-5">
		    <h3>Select Project</h3>  <ui-select ng-model="project.selected" theme="projects" ng-disabled="disabled" style="width: 300px;">
            <match placeholder="Select or search a project in the list..." >{{$select.selected.name}}</match>
            <choices repeat="project in projects | filter: $select.search">
              <span ng-bind-html="project.name | highlight: $select.search"></span>
              <!-- <small ng-bind-html="project.id | highlight: $select.search"></small> -->
            </choices>
          </ui-select></div></div>
          <div class="form-group"><div class="col-sm-5">
          <h3>User for the Project</h3>  <ui-select ng-model="user.selected" theme="selectize" ng-disabled="disabled" style="width: 300px;">
            <match placeholder="Select or search a username in the list...">{{$select.selected.name}}</match>
            <choices repeat="user in users | filter: $select.search">
              <span ng-bind-html="user.name | highlight: $select.search"></span>
              <!-- <small ng-bind-html="user.id | highlight: $select.search"></small> -->
            </choices></div></div>
          </ui-select>
        <!-- </div> -->

        <div class="form-group"><div class="col-sm-5"><p><input type="submit" class="btn btn-submit" name="submit" value="Assign" /></p></div></div>

<div ng-controller="customersCrtl">
<div class="container">
    <div class="row">


          

    </br> 
    </br> 
    </br> 
    </br> 
    <div class="row">
        <div class="col-md-12" data-ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
            <th>Project&nbsp;<a ng-click="sort_by('headlineP');"><i class="icon-angle-down"></i><i class="icon-angle-up"></i></a></th>
            <th>Assigned User&nbsp;<a ng-click="sort_by('username');"><i class="icon-angle-down"></i><i class="icon-angle-up"></i></a></th>
            </thead>
            <tbody>
                <tr class="del{{data.idJO}}" ng-repeat="data in filtered = (list | filter:project.selected.id | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.headlineP}}</td>
                    <td>{{data.name}}&nbsp;{{data.lastname}}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="col-md-12" data-ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No users for this project</h4>
            </div>
        </div>
        <div class="col-md-4">
            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total timeline projects</h5>
        </div>
        <div class="col-md-12" data-ng-show="filteredItems > 0">    
            <div data-pagination="" data-page="currentPage" data-on-select-page="setPage(page)" data-boundary-links="true" data-total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" data-previous-text="&laquo;" data-next-text="&raquo;"></div>
            
            
        </div>
    </div>
</div>
</div>
</div>

        <input type="hidden" name="idProjectJO" value="{{project.selected.id}}" required>
        <input type="hidden" name="idUsernameJO" value="{{user.selected.id}}" required>
	
		<!-- Table -->

</form>




    </div>

        <?php    

    		include("down.php");
    		
    		//make sure you close the check if their online
    		}
		
		?>
    <script type="text/javascript">

        $( document ).ready(function() {
          $("#radio_1").prop("checked", true);
          $("#radio_1").focus(); 
          console.log("Al");
        });

    </script>
  <script src="timelines/js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script type="text/javascript">   

    </script>

</body>
</html>
