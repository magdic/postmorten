<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

$idProject=$_REQUEST['id'];
$result = mysql_query("SELECT * FROM timeProject where idtimeLine='$idProject'");

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
                                                        <form action="../../controllers/addtimeline.php" method="post" class="form-horizontal" role="form">
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
                                                            <td><?php echo $row['media']; ?></td>
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






        <!-- <h1>Adding Timeline</h1>
        <a href="pm-panel.php">PM Panel</a>
        <h3>Your project is: <?php echo $prjctName; ?> </h3>
        <p> <?php echo $prjctText; ?> </br> <?php echo $prjctStartDate; ?> </p>
        <form action="../../controllers/addtimeline.php" method="post">
          <input type="hidden" id="idFromProject" name="idFromProject" value="<?php echo $idproject; ?>" readonly></input>
          <p>Timeline Start Date:<input type="text" placeholder="format yyyy,mm,dd" id="startDate" name="startDate"></input></p>
          <p>Headline:<input type="text" name="headline" id="headline" placeholder="Headline for the timeline"></input></p>
          <p>Text: <input type="text" placeholder="Reference Text" id="text" name="text"></input></p>
          <p>Media URL:<input type="text" placeholder="Media Url" id="media" name="media"></input></p>
          <p>Media Credit:<input type="text" placeholder="Credit" id="credit" name="credit"></input></p>
          <p>Media Caption:<input type="text" placeholder="Caption" id="caption" name="caption"></input></p>
          <p><input type="submit" name="submit" value="Add Timeline"></input></p>
        </form> -->

        <!-- Table -->
       <!--  <table class="table">
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
                <td><?php echo $row['media']; ?></td>
            </tr>
            <?php } ?>

          </tbody>
        </table> -->




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
        <script src="../assets/js/bootstrap-colorpicker.min.js"></script>
        <script src="../assets/js/jquery.knob.min.js"></script>
        <script src="../assets/js/jquery.autosize.min.js"></script>
        <script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="../assets/js/jquery.maskedinput.min.js"></script>
        <script src="../assets/js/bootstrap-tag.min.js"></script>

        <!-- ace scripts -->

        <script src="../assets/js/ace-elements.min.js"></script>
        <script src="../assets/js/ace.min.js"></script>


        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            jQuery(function($) {
                $('#id-disable-check').on('click', function() {
                    var inp = $('#form-input-readonly').get(0);
                    if(inp.hasAttribute('disabled')) {
                        inp.setAttribute('readonly' , 'true');
                        inp.removeAttribute('disabled');
                        inp.value="This text field is readonly!";
                    }
                    else {
                        inp.setAttribute('disabled' , 'disabled');
                        inp.removeAttribute('readonly');
                        inp.value="This text field is disabled!";
                    }
                });


                $(".chosen-select").chosen();
                $('#chosen-multiple-style').on('click', function(e){
                    var target = $(e.target).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                     else $('#form-field-select-4').removeClass('tag-input-style');
                });


                $('[data-rel=tooltip]').tooltip({container:'body'});
                $('[data-rel=popover]').popover({container:'body'});

                $('textarea[class*=autosize]').autosize({append: "\n"});
                $('textarea.limited').inputlimiter({
                    remText: '%n character%s remaining...',
                    limitText: 'max allowed : %n.'
                });

                $.mask.definitions['~']='[+-]';
                $('.input-mask-date').mask('99/99/9999');
                $('.input-mask-phone').mask('(999) 999-9999');
                $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
                $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});



                $( "#input-size-slider" ).css('width','200px').slider({
                    value:1,
                    range: "min",
                    min: 1,
                    max: 8,
                    step: 1,
                    slide: function( event, ui ) {
                        var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                        var val = parseInt(ui.value);
                        $('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
                    }
                });

                $( "#input-span-slider" ).slider({
                    value:1,
                    range: "min",
                    min: 1,
                    max: 12,
                    step: 1,
                    slide: function( event, ui ) {
                        var val = parseInt(ui.value);
                        $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
                    }
                });


                $( "#slider-range" ).css('height','200px').slider({
                    orientation: "vertical",
                    range: true,
                    min: 0,
                    max: 100,
                    values: [ 17, 67 ],
                    slide: function( event, ui ) {
                        var val = ui.values[$(ui.handle).index()-1]+"";

                        if(! ui.handle.firstChild ) {
                            $(ui.handle).append("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
                        }
                        $(ui.handle.firstChild).show().children().eq(1).text(val);
                    }
                }).find('a').on('blur', function(){
                    $(this.firstChild).hide();
                });

                $( "#slider-range-max" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                    value: 2
                });

                $( "#eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
                    // read initial values from markup and remove that
                    var value = parseInt( $( this ).text(), 10 );
                    $( this ).empty().slider({
                        value: value,
                        range: "min",
                        animate: true

                    });
                });


                $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });

                $('#id-input-file-3').ace_file_input({
                    style:'well',
                    btn_choose:'Drop files here or click to choose',
                    btn_change:null,
                    no_icon:'icon-cloud-upload',
                    droppable:true,
                    thumbnail:'small'//large | fit
                    //,icon_remove:null//set null, to hide remove/reset button
                    /**,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }*/
                    /**,before_remove : function() {
                        return true;
                    }*/
                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }

                }).on('change', function(){
                    //console.log($(this).data('ace_input_files'));
                    //console.log($(this).data('ace_input_method'));
                });


                //dynamically change allowed formats by changing before_change callback function
                $('#id-file-format').removeAttr('checked').on('change', function() {
                    var before_change
                    var btn_choose
                    var no_icon
                    if(this.checked) {
                        btn_choose = "Drop images here or click to choose";
                        no_icon = "icon-picture";
                        before_change = function(files, dropped) {
                            var allowed_files = [];
                            for(var i = 0 ; i < files.length; i++) {
                                var file = files[i];
                                if(typeof file === "string") {
                                    //IE8 and browsers that don't support File Object
                                    if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) return false;
                                }
                                else {
                                    var type = $.trim(file.type);
                                    if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )
                                            || ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )//for android's default browser which gives an empty string for file.type
                                        ) continue;//not an image so don't keep this file
                                }

                                allowed_files.push(file);
                            }
                            if(allowed_files.length == 0) return false;

                            return allowed_files;
                        }
                    }
                    else {
                        btn_choose = "Drop files here or click to choose";
                        no_icon = "icon-cloud-upload";
                        before_change = function(files, dropped) {
                            return files;
                        }
                    }
                    var file_input = $('#id-input-file-3');
                    file_input.ace_file_input('update_settings', {'before_change':before_change, 'btn_choose': btn_choose, 'no_icon':no_icon})
                    file_input.ace_file_input('reset_input');
                });




                $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .on('change', function(){
                    //alert(this.value)
                });
                $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'icon-caret-up', icon_down:'icon-caret-down'});
                $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'icon-plus smaller-75', icon_down:'icon-minus smaller-75', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});



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

                $('#colorpicker1').colorpicker();
                $('#simple-colorpicker-1').ace_colorpicker();


                $(".knob").knob();


                //we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
                var tag_input = $('#form-field-tags');
                if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) )
                {
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.variable_US_STATES,//defined in ace.js >> ace.enable_search_ahead
                      }
                    );
                }
                else {
                    //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    //$('#form-field-tags').autosize({append: "\n"});
                }




                /////////
                $('#modal-form input[type=file]').ace_file_input({
                    style:'well',
                    btn_choose:'Drop files here or click to choose',
                    btn_change:null,
                    no_icon:'icon-cloud-upload',
                    droppable:true,
                    thumbnail:'large'
                })

                //chosen plugin inside a modal will have a zero width because the select element is originally hidden
                //and its width cannot be determined.
                //so we set the width after modal is show
                $('#modal-form').on('shown.bs.modal', function () {
                    $(this).find('.chosen-container').each(function(){
                        $(this).find('a:first-child').css('width' , '210px');
                        $(this).find('.chosen-drop').css('width' , '210px');
                        $(this).find('.chosen-search input').css('width' , '200px');
                    });
                })
                /**
                //or you can activate the chosen plugin after modal is shown
                //this way select element becomes visible with dimensions and chosen works as expected
                $('#modal-form').on('shown', function () {
                    $(this).find('.modal-chosen').chosen();
                })
                */

            });
        </script>

<?php

        //make sure you close the check if their online
        }

        ?>
</body>
</html>
