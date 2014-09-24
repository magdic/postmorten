
<?php 

//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";

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
    <title>Timeline View | Postmorten</title>
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
    $nameUser = $row['name'];
    $lastnameUser = $row['lastname'];
    $fullnameUser = $nameUser.' '.$lastnameUser;

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


    <script type="text/javascript">


      $(function() {
        $(".view_comments").click(function() 
          {
            var ID = $(this).attr("id");

            $.ajax({
                type: "POST",
                url: "comments/viewajax.php?id=<?php echo $idProject; ?>",
                data: "idComment="+ ID, 
                cache: false,
                success: function(html){
                  $("#view_comments"+ID).prepend(html);
                  $("#view"+ID).remove();
                  $("#two_comments"+ID).remove();
                }
            });

      return false;
      });
      });


    </script>


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
        <?php 
        $res = mysql_query("SELECT * FROM timelines where idFromProject = '$json_id'");
          //split all fields fom the correct row into an associative array
        $row = mysql_fetch_assoc($res);
        if(empty($row['idtimelines'])){
          echo '
          <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">
          <i class="icon-remove"></i>
          </button>

          <strong>
          <i class="icon-remove"></i>
          This is not an error!
          </strong>

          The timeline still haven\'t been created.
          <br>
          </div>';die();
        } 

        ?>
        <div class="page-content">
          <div class="page-header">
            <h1>Timeline</h1>
          </div><!-- /.page-header -->
          <div id="demo">
            <div id="timeline-embed"></div>
          </div>
          <div class="hr hr32 hr-dotted"></div>
          <!-- COMMENTS -->
          <div class="widget-box ">
            <div class="widget-header">
              <h4 class="lighter smaller">
                <i class="icon-comment blue"></i>
                Conversation
              </h4>
            </div>

            <div class="widget-body">
              <div class="widget-main no-padding">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;"><div class="dialogs" style="overflow: hidden; width: auto; height: 300px;">


                  <form role="form" method="post" action="comments/savecomment.php">
                    <!-- <form id="savecomment" action="comments/savecomment.php" method="post"> -->
                    <div class="form-actions">
                      <small><?php echo $fullnameUser; ?></small>
                      <div class="input-group">
                        <?php $idProject=$_REQUEST['id']; ?>
                        <input name="idProject" type="hidden" value="<?php echo $idProject ?>" />
                        <input name="userComment" type="hidden" value="<?php echo $uid ?>" />
                        <input placeholder="Type your message here ..." type="text" class="form-control" name="message" id="commentin">
                        <span class="input-group-btn">
                         <input class="btn btn-sm btn-info no-radius" type="submit" name="submit" id="send-comment" />
                       </span>
                     </div>
                   </div>
                 </form>

                 <?php
                 $msql=mysql_query("SELECT * FROM postmorten_db.comment As a, postmorten_db.users AS users WHERE a.userComment = users.id AND a.idProject ='$idProject' ORDER BY a.idComment DESC");
                 while($messagecount=mysql_fetch_array($msql))
                 {
                  $idComment=$messagecount['idComment'];
                  $msgcontent=$messagecount['bodycomment'];
                  $dateToday=$messagecount['dateToday'];
                  $user_name_comment=$messagecount['name'];
                  $user_lastname_comment=$messagecount['lastname'];
                  ?>

                  <div class="comment">
                    <div class="name">
                      <span id="user-says">
                        <?php echo '<span class="label label-success arrowed-in arrowed-in-right">'.$user_name_comment .' '. $user_lastname_comment.'</span>'; ?>
                      </span>
                    </div>
                    <!-- <div class="itemdiv dialogdiv"> -->
                      <div class="itemdiv dialogdiv">
                        <div class="body">
                          <div class="time">
                            <i class="icon-time"></i>
                            <span class="green"><?php echo $dateToday; ?></span>
                          </div>

                          <span>
                            <!-- THIS IS THE MESSAGE FOR START A CONVERSATION ON THE COMMENTS SECTION -->
                            <?php echo '<span class="">'.$msgcontent.'</span>'; ?>
                          </span>


                          <div class="conversation" style="margin-top:10px; margin-left: 58px;">
                            <?php 

                            $sql=mysql_query("SELECT * FROM subComment WHERE idFromComment='$idComment' ORDER BY idSubComment");
                            $comment_count=mysql_num_rows($sql);

                            if($comment_count>2)
                            {
                              $second_count=$comment_count-2;
                              ?>
                              <div class="comment_ui" id="view<?php echo $idComment; ?>">
                                <div>
                                  <a href="#" class="view_comments" id="<?php echo $idComment; ?>"><i class="icon-comments"></i> Read <?php echo $second_count; ?> more comments.</a>
                                </div>
                              </div>
                              <?php 
                            } 
                            else 
                            {
                              $second_count=0;
                            }
                            ?>

                            <div id="view_comments<?php echo $idComment; ?>"></div>

                            <div id="two_comments<?php echo $idComment; ?>">
                              <?php
                              $listsql=mysql_query("SELECT * FROM subComment AS a, users AS b WHERE a.idFromComment='$idComment' AND a.userSubComment=b.id ORDER BY idSubComment LIMIT $second_count,2 ");
                              while($rowsmall=mysql_fetch_array($listsql))
                              { 
                                $c_id=$rowsmall['idSubComment'];
                                $comment=$rowsmall['subComment'];
                                $nameSub=$rowsmall['name'];
                                $lastnameSub=$rowsmall['lastname'];
                                $dateSub=$rowsmall['dateSubComment'];
                                ?>

                                <div class="comment_ui">

                                  <div class="comment_text">
                                    <div  class="comment_actual_text">
                                      <div id="sssss"><?php echo '<span class="label label-success arrowed-in arrowed-in-right">'.$nameSub.' '.$lastnameSub.'</span><div class="itemdiv dialogdiv"><div class="body"><div class="time"><i class="icon-time"></i><span class="green">'.$dateSub.'</span></div>'.$comment.'</div></div>'; ?></div></div>
                                    </div>

                                  </div>

                                  <?php } ?>
                                  <div class="dddd">
                                    <div>

                                      <form id="subcomments" action="comments/savesubcomment.php" method="post">
                                        <div class="form-actions">
                                          <!-- <small><?php echo $nameUser.' '.$lastnameUser; ?></small> -->
                                          <div class="input-group">
                                            <input name="idProject" type="hidden" value="<?php echo $idProject ?>" />
                                            <input name="mesgid" type="hidden" value="<?php echo $idComment ?>" />
                                            <input name="idUserSub" type="hidden" value="<?php echo $uid ?>" />
                                            <input id="subcommentin" placeholder="Type your message here ..." type="text" class="form-control" name="mcomment">
                                            <span class="input-group-btn">
                                              <input class="btn btn-sm btn-info no-radius" type="submit">
                                            </span>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>


                              </div>


                            </div>
                          </div>
                        <!-- </div> -->

                      </div>
                      <?php
                    }
                    ?>
                    <!-- </ol> -->


                  </div><div class="slimScrollBar ui-draggable" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 228.4263959390863px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>


                </div><!-- /widget-main -->
              </div><!-- /widget-body -->
            </div><!-- END FOR COMMENTS -->

          </div>
          <script type="text/javascript">
          var timeline_config = {
           width: "100%",
           height: "80%",
           source: "../../../json.php?id=<?php echo $json_id;?>",
           font: "PTSerif-PTSans"
         }

        //  $(function () {
        //   $('#savecomment').on('submit', function (e) {

        //     e.preventDefault();
        //     $.ajax({
        //       type: 'post',
        //       url: 'comments/savecomment.php',
        //       data: $('#savecomment').serialize(),
        //       success: function (data) {
        //         $("#commentin").val("");

        //         if($('.comment').length > 0){
        //           $('.comment').fadeOut(1000).load("# .comment").fadeIn(1000);
        //         } else {
        //           location.reload();
        //         }
        //       }

        //     });
        //     return false;
        //   });
        // });




         </script>
         <script type="text/javascript" src="build/js/storyjs-embed.js"></script>
         <!-- END Timeline Embed-->
         <?php include("down.php");
    //make sure you close the check if their online
       } ?>
     </body>
     </html>