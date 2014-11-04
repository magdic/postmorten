<?php 
//allow sessions to be passed so we can see if the user is logged in
//session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

$id=$_REQUEST['id'];
$idProject=$_REQUEST['project'];

// echo 'The id is: '.$id. ' + '.$idProject;
// die();

 ?>
<html>
<head>
	<title>Deleteing Project | Postmorten App</title>

        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../../assets/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="../../assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../../assets/css/ace.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />

        <!-- inline styles related to this page -->
        
        <link rel="stylesheet" href="../../assets/css/main.css" />

        <!-- ace settings handler -->
        <link rel="stylesheet" href="../../assets/css/datepicker.css" />
        <script src="../../assets/js/ace-extra.min.js"></script>
        <script src='../../assets/js/jquery-2.0.3.min.js'></script>
</head>
<body>
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable" tabindex="-1" role="dialog" aria-describedby="dialog-confirm" aria-labelledby="ui-id-27" style="height: auto; width: 300px; top: 275px; left: 570px; display: block;">
	<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
		<span id="ui-id-27" class="ui-dialog-title">
			<div class="widget-header">
				<h4 class="smaller"><i class="icon-warning-sign red">
				</i> Deleting Project?</h4>
			</div>
		</span>
	</div>
	<div id="dialog-confirm" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 28px; max-height: none; height: auto;">
				<div class="alert alert-info bigger-110">
					This action cannot be recovered.
				</div>

	<div class="space-6"></div>

	<p class="bigger-110 bolder center grey">
		<i class="icon-hand-right blue bigger-120"></i>
		Are you sure?
	</p>
	</div>
	<div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
		<div class="center">
			<a href="../../controllers/deleteProject.php?id=<?php echo $id; ?>" class="btn btn-danger btn-xs ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"><i class="icon-trash bigger-110"></i>&nbsp; Delete</span></a>
			<!-- <a id="close-modal-tl" href="" class="btn btn-xs ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"><i class="icon-remove bigger-110"></i>&nbsp; Cancel</span></a> -->
		</div>
	</div>
</div>


</body>
</html>




