<?php 
//allow sessions to be passed so we can see if the user is logged in
//session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";




$id=$_REQUEST['id'];




$query = mysql_query("SELECT * FROM projectsTB WHERE idtimeLine = '".$id."'") or die(mysql_error());

while ($row = mysql_fetch_array($query)) {
	$id = $row['idtimeLine'];
	$date = $row['startDateP'];
	$headline = $row['headlineP'];
	$text = $row['textP'];
	$media = $row['mediaP'];
	$credit = $row['creditP'];
	$caption = $row['captionP'];

}


 ?>
<html>
<head>
	<title>Editing Timeline | Postmorten App</title>

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="../assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../assets/css/ace.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

        <!-- inline styles related to this page -->
        
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/chosen.css">
    	<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css">

        <!-- ace settings handler -->
        <link rel="stylesheet" href="../assets/css/datepicker.css" />
        <script src="../assets/js/ace-extra.min.js"></script>
        <script src='../assets/js/jquery-2.0.3.min.js'></script>
</head>
<body>
<div class="panel-body">
    <h3 align="center">Adding a New User</h3>
<form action="../../controllers/admin-add-user.php" method="post" class="form-horizontal" role="form">
     <fieldset>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name: </label>
            <div class="col-sm-8">
                <input  type="text" name="name" placeholder="First Name" class="col-xs-12 col-sm-10" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Last name:  </label>
            <div class="col-sm-8">
                <input type="text" id="form-field-2 headline" name="lastName" placeholder="Last Name" class="col-xs-12 col-sm-10">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> User:  </label>
            <div class="col-sm-8">
                <input  type="text" id="form-field-2 headline" name="user" placeholder="User Id like CM email" class="col-xs-12 col-sm-10">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Position:  </label>
            <div class="col-sm-8">
                <select name="position" class="col-xs-12 col-sm-10">
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
            <input type="submit" name="submit" class="btn btn-sm btn-success btn-block">
               <!--  Submit
                <i class="icon-arrow-right icon-on-right bigger-110"></i> -->

        </div>
    </form>
</div>

<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>



<!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
                window.jQuery || document.write("<script src='../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="../assets/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js/chosen.jquery.min.js"></script>
        <script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
        <script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="../assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="../assets/js/date-time/moment.min.js"></script>
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

<script>

       

    </script>

</body>
</html>




