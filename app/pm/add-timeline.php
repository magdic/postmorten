<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

$idProject=$_REQUEST['id'];
$result = mysql_query("SELECT * FROM projectsTB where idtimeLine='$idProject'");

while($row = mysql_fetch_array($result))
  {
    $idproject=$row['idtimeLine'];
    $prjctName=$row['headlineP'];
    $prjctType=$row['typeP'];
    $prjctText=$row['textP'];
    $prjctStartDate=$row['startDateP'];
}


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
<html>
<head>
    <title>Adding Timelines | my App</title>
     <script src="//localhost:35729/livereload.js"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="../assets/css/chosen.css" />
        <link rel="stylesheet" href="../assets/css/datepicker.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="../assets/css/daterangepicker.css" />
        <link rel="stylesheet" href="../assets/css/colorpicker.css" />

        <!-- fonts -->

        <link rel="stylesheet" href="../assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../assets/css/ace.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../assets/css/main.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />

        <script src="../assets/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->

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
            echo "<center>You are not an <b>PM User</b> site!</center>";
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
                               <!--  <img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" /> -->
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
                        <li>
                            <a href="timelines-to-me.php">
                                <i class="icon-sitemap"></i>
                                <span class="menu-text"> Timelines assigned </span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul style="display: block;" class="submenu">
                                <li class="active">
                                    <a href="add-timeline.php">
                                        <i class="icon-plus"></i>
                                        <span class="menu-text"> Add timeline feedback </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        </li>
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
                                    Timelines assigned
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Add timeline feedback
                                    </small>
                                </h1>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 center centered">
                                    <h3>Your project is: <?php echo $prjctName; ?> </h3>
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
                                                            <i class="icon-angle-down bigger-110" data-icon-hide="icon-angle-down" data-icon-show="icon-angle-right"></i>
                                                           Add timeline feedback
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div class="panel-collapse collapse" id="collapseOne">
                                                    <div class="panel-body">
                                                        <form action="../../controllers/addtimeline.php" method="post" class="form-horizontal" role="form" onsubmit="return getContent()">
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
                                                                        <input type="hidden" id="form-field-3" name="text"  />
                                                                        <!-- <div class="wysiwyg-toolbar btn-toolbar center wysiwyg-style2">  </div> -->
                                                                        <div class="wysiwyg-editor" id="editor1" contenteditable="true" ></div>
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








       <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
                window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js/chosen.jquery.min.js"></script>
        <script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
        <script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="../assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="../assets/js/date-time/moment.min.js"></script>
        <script src="../assets/js/date-time/daterangepicker.min.js"></script>
        <script src="../assets/js/jquery.autosize.min.js"></script>
        <script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="../assets/js/jquery.maskedinput.min.js"></script>
        <script src="../assets/js/bootstrap-tag.min.js"></script>
        <script src="../assets/js/markdown/markdown.min.js"></script>
        <script src="../assets/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="../assets/js/jquery.hotkeys.min.js"></script>
        <script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../assets/js/bootbox.min.js"></script>

        <!-- ace scripts -->

        <script src="../assets/js/ace-elements.min.js"></script>
        <script src="../assets/js/ace.min.js"></script>

        <script src="../assets/js/url-preview.js"></script>


        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            jQuery(function($) {

                $("form").on("submit",function() {
                    wysiwygText = $("#editor1").html();
                    $("#form-field-3").val(wysiwygText);
                });


             


                $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function(){
                    $(this).next().focus();
                });

                $('#timepicker1').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });




                    //but we want to change a few buttons colors for the third style
                    $('#editor1').ace_wysiwyg({
                        toolbar:
                        [
                            // 'font',
                            null,
                            'fontSize',
                            null,
                            {name:'bold', className:'btn-info'},
                            {name:'italic', className:'btn-info'},
                            {name:'strikethrough', className:'btn-info'},
                            {name:'underline', className:'btn-info'},
                            null,
                            {name:'insertunorderedlist', className:'btn-success'},
                            {name:'insertorderedlist', className:'btn-success'},
                            // {name:'outdent', className:'btn-purple'},
                            // {name:'indent', className:'btn-purple'},
                            null,
                            {name:'justifyleft', className:'btn-primary'},
                            {name:'justifycenter', className:'btn-primary'},
                            {name:'justifyright', className:'btn-primary'},
                            {name:'justifyfull', className:'btn-inverse'},
                            null,
                            {name:'createLink', className:'btn-pink'},
                            {name:'unlink', className:'btn-pink'},
                            null,
                            // {name:'insertImage', className:'btn-success'},
                            null,
                            // 'foreColor',
                            null,
                            {name:'undo', className:'btn-grey'},
                            {name:'redo', className:'btn-grey'}
                        ],
                        'wysiwyg': {
                            // fileUploadError: showErrorAlert
                        }
                    }).prev().addClass('wysiwyg-style2');

                        $('[data-toggle="buttons"] .btn').on('click', function(e){
                                var target = $(this).find('input[type=radio]');
                                var which = parseInt(target.val());
                                var toolbar = $('#editor1').prev().get(0);
                                if(which == 1 || which == 2 || which == 3) {
                                    toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
                                    if(which == 1) $(toolbar).addClass('wysiwyg-style1');
                                    else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
                                }
                            });



            });
        </script>

<?php

        //make sure you close the check if their online
        }

        ?>
</body>
</html>
