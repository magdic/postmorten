<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

$BASE_URL = 'http://localhost:8888/phpcodes/postmorten/app/admin/';

$idUser = $_REQUEST['id'];
 
$user_query = "SELECT * FROM usersFromDB WHERE idDB = ".$idUser." ";
$result = mysql_query($user_query);

while($row = mysql_fetch_array($result))
  {
    $idUserTable=$row['idDB'];
    $name=$row['nameFDB'];
    $lastname=$row['lastNameFDB'];
    $position=$row['position'];
    $department=$row['department'];
}

if ($idUserTable == '') {
    header("location: ./");
}

?>


<!DOCTYPE html>
<html data-ng-app="myApp" lang="en">
<head>
	<title>Admin Managing Users | Postmorten App</title>

	<?php include('header.php'); ?>
    <link href="../assets/css/jquery.fs.boxer.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>

<script>
$(document).ready(function() {
    $(".boxer").not(".retina, .boxer_fixed, .boxer_top, .boxer_format, .boxer_mobile, .boxer_object").boxer();

    $(".boxer.boxer_fixed").boxer({
        fixed: true
    });

    $(".boxer.boxer_top").boxer({
        top: 50
    });

    $(".boxer.retina").boxer({
        retina: true
    });

    $(".boxer.boxer_format").boxer({
        formatter: function($target) {
            return '<h3>' + $target.attr("title") + "</h3>";
        }
    });

    $(".boxer.boxer_object").click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        $.boxer( $('<div class="inline_content"><h2>More Content!</h2><p>This was created by jQuery and loaded into the new Boxer instance.</p></div>') );
    });

    $(".boxer.boxer_mobile").boxer({
        mobile: true
    });
});
</script>

	<div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="./" class="navbar-brand">
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
		        <a href="./">
		            <i class="icon-dashboard"></i>
		            <span class="menu-text"> Admin Panel </span>
		        </a>
		    </li>
		    <li class="active">
		        <a href="users.php">
		            <i class="icon-group"></i>
		            <span class="menu-text"> Users </span>
		        </a>
		    </li>
		    <li>
		        <a href="projects.php">
		            <i class="icon-save"></i>
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
                    <a href="./">Home</a>
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
                Admin | Editing Users
                    <small>
                        <i class="icon-double-angle-right"></i>
                        <a href="<?php echo $BASE_URL; ?>deleteUser.php?id=<?php echo $idUser ?>" class="btn btn-xs btn-danger boxer button small">Delete User</a>
                    </small>
            </h1>
			</div><!-- /.page-header -->

            <form action="../../controllers/admin-edit-user.php" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="idUser" value="<?php echo $idUser; ?>" readonly />
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name: </label>
                        <div class="col-sm-8">
                            <input type="text"  name="name" placeholder="<?php echo $name; ?>" value="<?php echo $name; ?>" class="col-xs-12 col-sm-8" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name: </label>
                        <div class="col-sm-8">
                            <input type="text"  name="lastname" placeholder="<?php echo $lastname; ?>" value="<?php echo $lastname; ?>" class="col-xs-12 col-sm-8" />
                        </div>
                    </div>
<!--                     <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Position: </label>
                        <div class="col-sm-8">
                            <input type="text"  name="position" placeholder="<?php echo $position; ?>" value="<?php echo $position; ?>" class="col-xs-12 col-sm-8" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department: </label>
                        <div class="col-sm-8">
                            <input type="text"  name="department" placeholder="<?php echo $department; ?>" value="<?php echo $department; ?>" class="col-xs-12 col-sm-8" />
                        </div>
                    </div> -->


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Position:  </label>
            <div class="col-sm-8">
                <select name="position" class="col-xs-12 col-sm-10">
                    <option default value="<?php echo $position; ?>"><?php echo $position; ?></option>
                    <option value="1">Admin</option>
                    <option value="2">Lead</option>
                    <option value="3">Project Manager</option>
                    <option value="4">Developer/Designer/QA</option>
                </select>
                <!-- <input  type="select" id="form-field-2 headline" name="position" placeholder="Position" class="col-xs-12 col-sm-10"> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Department:  </label>
            <div class="col-sm-8">
                <select name="department" class="col-xs-12 col-sm-10">
                    <option default value="<?php echo $department; ?>"><?php echo $department; ?></option>
                    <option value="1">Administrative</option>
                    <option value="2">IT Support</option>
                    <option value="3">Technology</option>
                    <option value="4">Creative</option>
                    <option value="5">QA</option>
                </select>
                <!-- <input  type="text" id="form-field-2 headline" name="department" placeholder="User Id like CM email" class="col-xs-12 col-sm-10"> -->
            </div>
        </div>


                </fieldset>
                    <div class="form-actions center">
                        <input type="submit" name="submit" class="btn btn-sm btn-success btn-block" value="Edit" />
                    </div>
            </form>

		</div>	

        </div>
    </div>
</div>
                

<?php //make sure you close the check if their online
include("down.php");
	}
?>
    <script src="../assets/js/jquery.fs.boxer.js"></script>   
</body>
</html>
