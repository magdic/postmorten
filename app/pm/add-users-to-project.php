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
<html ng-app="demo">
<head>
    <title>Add users to project | my App</title>

     <script src="//localhost:35729/livereload.js"></script>

    <!-- basic styles -->

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <link rel="stylesheet" href="../assets/css/chosen.css" />

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
                            </a>
                        </li>
                         <li class="active">
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
                            <!-- <li class="active">Timelines</li> -->
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
                                               Add user to a project
                                            </small>
                                        </h1>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">



    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-sanitize.js"></script>
    <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css"> -->

    <!-- ui-select files -->
    <script src="plunk/select.js"></script>
    <link rel="stylesheet" href="plunk/select.css">

    <!--  IT'S THE SAME THAT YOU CALL AN EXTERNAL SCRIPT <script src="demo.js"></script> -->
    <?php include("plunk/demojs.php"); ?>

    <!-- Select2 theme -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">

  <!--
    Selectize theme
    Less versions are available at https://github.com/brianreavis/selectize.js/tree/master/dist/less
  -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css">


        <form action="../../controllers/hook-users-to-project.php" method="post" ng-controller="DemoCtrl">
       <!--  ANGULAR FORM WAY TO SEARCH AND SELECT PROJECTS AND USERS-->
          <div class="form-group"><div class="col-sm-5">
          <h3>User for the Project</h3>  <ui-select ng-model="user.selected" theme="selectize" ng-disabled="disabled" style="width: 300px;">
            <match placeholder="Select or search a username in the list...">{{$select.selected.name}}</match>
            <choices repeat="user in users | filter: $select.search">
              <span ng-bind-html="user.name | highlight: $select.search"></span>
              <!-- <small ng-bind-html="user.id | highlight: $select.search"></small> -->
            </choices></div></div>
          </ui-select>
           <div class="form-group">
        <div class="col-sm-5">
            <h3>Select Project</h3>  <ui-select ng-model="project.selected" theme="projects" ng-disabled="disabled" style="width: 300px;">
            <match  placeholder="Select or search a project in the list...">{{$select.selected.name}}</match>
            <choices repeat="project in projects | filter: $select.search">
              <span ng-bind-html="project.name | highlight: $select.search"></span>
              <!-- <small ng-bind-html="project.id | highlight: $select.search"></small> -->
            </choices>
          </ui-select></div></div>
        <!-- </div> -->
        <!-- <p>Selected Project: {{project.selected.id}}</p> -->
        <input type="hidden" name="idUsernameJO" value="{{user.selected.id}}" required>
        <input type="hidden" name="idProjectJO" value="{{project.selected.id}}" required>

        <div class="form-group"><div class="col-sm-5"><p><input type="submit" class="btn btn-info" name="submit" value="Assign" /></p></div></div>
        </form>

        <!-- Table -->
        <table class="table">
          <thead>
            <tr>
              <th>Project</th>
              <th>PM User</th>
            </tr>
          </thead>
          <tbody>

            <?php $query = mysql_query("SELECT * FROM timeProject AS a, users AS b, joinedTB AS c WHERE a.idtimeLine = c.idProjectJO AND b.id = c.idUsernameJO") or die(mysql_error());
                while ($row = mysql_fetch_array($query)) {
                    $id = $row['idtimeLine']; ?>

            <tr>
                <td><?php echo $row['headlineP']; ?></td>
                <td><?php echo $row['name']; echo ' '.$row['lastname'];  ?></td>
            </tr>
            <?php } ?>

          </tbody>
        </table>
    </div>


                                    </div>
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
            </div>
        </div>



         <!--    <div class="main-content">
                <h1>Create a Project</h1>
                    <a href="pm-panel.php">Lead Panel</a>
                    <form action="../../controllers/addproject.php" method="post">
                    <p>Project Name:   <input type="text" placeholder="This is the Headline" id="projectname" name="projectname"></input></p>
                    <p>Type:           <input type="text" value="default" name="type" readonly></input></p>
                    <p>Reference Text: <input type="text" placeholder="Reference Text" id="reference" name="reference"></input></p>
                    <p>Start Date:     <input type="text" placeholder="yyyy,mm,dd" id="startdate" name="startdate"></input></p>
                    <p><input type="submit" name="submit" value="Create Project"></input></p>
                    </form>
            </div> -->

        <script src='../assets/js/jquery-2.0.3.min.js'></script>
        <script src='../assets/js/jquery.mobile.custom.min.js'></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="../assets/js/bootstrap-tag.min.js"></script>
        <script src="../assets/js/jquery.hotkeys.min.js"></script>
        <script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>

        <script src="../assets/js/chosen.jquery.min.js"></script>

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
                });

                var oTable1 = $('#sample-table-2').dataTable( {
                "aoColumns": [
                  { "bSortable": false },
                  null, null,null,
                  { "bSortable": false }
                ] } );


                $('table th input:checkbox').on('click' , function(){
                    var that = this;
                    $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

                });


                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    var w2 = $source.width();

                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
            })
        </script>

<?php

        //make sure you close the check if their online
        }

        ?>
</body>
</html>
