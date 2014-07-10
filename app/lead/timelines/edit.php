
<?php 

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";

$idProject = $_REQUEST['id'];
$result = mysql_query("SELECT * FROM timeProject where idtimeLine='$idProject'");

while($row = mysql_fetch_array($result))
  {
    $idproject=$row['idtimeLine'];
    $prjctName=$row['headlineP'];
    $prjctType=$row['typeP'];
    $prjctText=$row['textP'];
    $prjctStartDate=$row['startDateP'];
}


?>

<!DOCTYPE html>
<html  lang="en"><!--
  	 
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
    <title>Edit Timelines | Postmorten App</title>
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
            <span class="menu-text"> See Timelines </span>
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

      <div class="page-content">
      	<div class="page-header">
                                <h1>
                                    Timelines 
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Editing Timeline <?php echo $idProject; ?>
                                    </small>
                                </h1>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 center centered">
                                    <h3>Project Name:</br> <?php echo $prjctName; ?> </h3>
                                    <p> Project Description: <?php echo $prjctText; ?> </br> Start Date: <?php echo $prjctStartDate; ?> </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-9 centered">
                                    <div id="accordion" class="accordion-style1 panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                            <i class="icon-plus bigger-110" data-icon-hide="icon-angle-down" data-icon-show="icon-angle-right"></i>
                                                           Add New Timeline Feedback
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div class="panel-collapse collapse" id="collapseOne">
                                                    <div class="panel-body">
                                                        <form action="../../../controllers/addtimelinelead.php" method="post" class="form-horizontal" role="form">
                                                            <input type="hidden" id="idFromProject" name="idFromProject" value="<?php echo $idproject; ?>" readonly />
                                                            <fieldset>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Timeline Start Date: </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="id-date-picker-1 startDate" name="startDate" placeholder="YYYY,MM,DD" class="col-xs-12 col-sm-10 date-picker" data-date-format="yyyy,mm,dd" />
                                                                        <span class="input-group-addon">
                                                                            <i class="icon-calendar bigger-110"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Headline:  </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="form-field-2 headline" name="headline" placeholder="Headline for the timeline" class="col-xs-12 col-sm-10" />
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Text: </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="form-field-3 text" name="text" placeholder="Reference text" class="col-xs-12 col-sm-10" />
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-4"> Media URL: </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="form-field-4 media" name="media" placeholder="Media URL" class="col-xs-12 col-sm-10" />
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5"> Media Credit: </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="form-field-5 credit" name="credit" placeholder="Credit" class="col-xs-12 col-sm-10" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-6"> Media Caption: </label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="form-field-6 caption" name="caption" placeholder="Caption" class="col-xs-12 col-sm-10" />
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                                <div class="form-actions center">
                                                                    <input type="submit" name="submit" class="btn btn-sm btn-success btn-block" />
                                                                       <!--  Submit
                                                                        <i class="icon-arrow-right icon-on-right bigger-110"></i> -->

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="space-4"></div>
                                </div><!-- /span -->
                            </div><!-- /row -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Start Date</th>
                                                            <th>Headline</th>
                                                            <th>Text</th>
                                                            <th>Media</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php $query = mysql_query("SELECT * FROM timelines WHERE idFromProject='$idProject'") or die(mysql_error());
                                                            while ($row = mysql_fetch_array($query)) {
                                                                $id = $row['idtimelines']; ?>
                                                        <tr>
                                                            <td><?php echo $row['startDate']; ?></td>
                                                            <td><?php echo $row['headline']; ?></td>
                                                            <td><?php echo $row['text'];?></td>
                                                            <td> 
                                                            <?php 
                                                                // THIS SECTION IS FOR RECOGNIZE THE URL FROM VIDEOS,
                                                                // BECAUSE THE PLUGIN FOR THE PREVIEW IMAGE LINK IS JUST FOR .IMAGES 
                                                                // EXAMPLE: .JPG .PNG 

                                                                $isvideo = $row['media']; 
                                                                $youtube = 'youtube.com';
                                                                $youtu_be = 'youtu.be';
                                                                $vimeo = 'vimeo';
                                                                $youtubeID = substr($isvideo,'-11:');
                                                                $vimeoID = substr($isvideo,'-8:');

                                                                $imgid = $vimeoID;

                                                                

                                                                if(strpos($isvideo,$youtube) !== false || strpos($isvideo,$youtu_be) !== false) {
                                                                    echo '<a href="#" class="screenshot" rel="http://img.youtube.com/vi/'.$youtubeID.'/mqdefault.jpg">'.$row['media'].'</a>';
                                                                } else
                                                                if(strpos($isvideo,$vimeo) !== false){
                                                                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));

                                                                    $vimeoimg = $hash[0]['thumbnail_medium'];  
                                                                    echo '<a href="#" class="screenshot" rel="'.$vimeoimg.'">'.$row['media'].'</a>';

                                                                } 
                                                                else {
                                                                    echo '<a href="#" class="screenshot" rel="'.$row['media'].'">'.$row['media'].'</a>';
                                                                }


                                                           ?>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /span -->
                                    </div><!-- /row -->
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
      
  </body>
  <script src="../../assets/js/url-preview.js"></script>
</html>