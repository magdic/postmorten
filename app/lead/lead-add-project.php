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
<html>
<head>
	<title>Lead Create a Project | my App</title>
	
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

 <ul class="nav nav-list">
    <li>
        <a href="lead-panel.php">
            <i class="icon-dashboard"></i>
            <span class="menu-text"> Lead Panel</span>
        </a>
    </li>
    <li class="active">
        <a href="lead-add-project.php">
            <i class="icon-save"></i>
            <span class="menu-text"> Create Project </span>
        </a>
    </li>
    <li>
        <a href="add-pm-to-project.php">
            <i class="icon-group"></i>
            <span class="menu-text"> Add PM to project </span>
        </a>
    </li>
    <li>
        <a href="./timelines">
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

			<div class="page-content">
						<div class="page-header">
							<h1>
								Adding New Project
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="hr hr-18 hr-double dotted"></div>

								<div class="row-fluid">
									<div class="span12">
										<div class="widget-box">
											<div class="widget-header widget-header-blue widget-header-flat">
												<h4 class="lighter">New Project</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="step-content row-fluid position-relative" id="step-container">
														<div class="step-pane active" id="step1">
															<h3 class="lighter block green">Information about the Project</h3>

												

															<form class="form-horizontal" id="validation-form" action="../../controllers/addproject.php" method="post" novalidate="novalidate">
																<div class="form-group">
																	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="projectname">Project Name:</label>

																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			<input type="text" name="projectname" id="projectname" class="col-xs-12 col-sm-6">
																		</div>
																	</div>
																</div>

																<div class="space-2"></div>

																<div class="form-group">
																	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="type">Type:</label>

																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			<input type="text" name="type" id="type" class="col-xs-12 col-sm-6" value="default" readonly disabled="disabled">
																		</div>
																	</div>
																</div>

																<div class="space-2"></div>



																<div class="hr hr-dotted"></div>



																<div class="form-group">
																	<label class="col-sm-3 control-label no-padding-right"  for="reference">Reference text for the project</label>

																	<div class="col-sm-7">
																		<!-- <div class="clearfix"> -->
																			<input type="hidden" id="form-field-3" name="reference"  />
	                                                                        <!-- <div class="wysiwyg-toolbar btn-toolbar center wysiwyg-style2">  </div> -->
	                                                                        <div class="wysiwyg-editor" id="reference" contenteditable="true" ></div>
																			<!-- <textarea class="col-xs-12 col-sm-6" name="reference" id="reference"></textarea> -->
																		<!-- </div> -->
																	</div>
																</div>

																<div class="space-8"></div>



																<div class="form-group">
																	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="startdate">Start Date Project:</label>
																	<div class="col-xs-12 col-sm-3">
																		<div class="input-group">
																			<input class="form-control date-picker" id="id-date-picker-1" name="startdate" type="text" data-date-format="yyyy,mm,dd">
																				<span class="input-group-addon">
	                                                                      			<i class="icon-calendar bigger-110"></i>
																				</span>
	                                                              		</div>
	  																</div>
  																</div>

																<div class="form-group">
																	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="media">Main Image/Video:</label>

																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			<input type="text" name="main-media" id="main-media" class="col-xs-12 col-sm-6">
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="mediacredit">Credit Media:</label>

																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			<input type="text" name="credit-media" id="credit-media" class="col-xs-12 col-sm-6">
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="mediacaption">Caption Media:</label>

																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			<input type="text" name="caption-media" id="caption-media" class="col-xs-12 col-sm-6">
																		</div>
																	</div>
																</div>																																

																<div class="space-2"></div>

													<div class="row-fluid wizard-actions">
															<input type="submit" name="submit" class="btn btn-success btn-next" value="Create Project"></input>
													</div>


															</form>
														</div>

													</div>

													<hr>

												</div><!-- /widget-main -->
											</div><!-- /widget-body -->
										</div>
									</div>
								</div>


							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>



<?php

		include("down.php");
		
		//make sure you close the check if their online
		}
		
		?>
		<script src="../assets/js/markdown/markdown.min.js"></script>
        <script src="../assets/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script type="text/javascript">
			jQuery(function($) {

				$("form").on("submit",function() {
                    wysiwygText = $("#reference").html();
                    $("#form-field-3").val(wysiwygText);
                });


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

                // $(".chosen-select").chosen();
                // $('#chosen-multiple-style').on('click', function(e){
                //     var target = $(e.target).find('input[type=radio]');
                //     var which = parseInt(target.val());
                //     if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                //      else $('#form-field-select-4').removeClass('tag-input-style');
                // });



				$('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                $('#timepicker1').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });



                //but we want to change a few buttons colors for the third style
                    $('#reference').ace_wysiwyg({
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
                    }).prev().addClass('wysiwyg-style3');

                        $('[data-toggle="buttons"] .btn').on('click', function(e){
                                var target = $(this).find('input[type=radio]');
                                var which = parseInt(target.val());
                                var toolbar = $('#reference').prev().get(0);
                                if(which == 1 || which == 2 || which == 3) {
                                    toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
                                    if(which == 1) $(toolbar).addClass('wysiwyg-style1');
                                    else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
                                }
                            });



            });


		</script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="../assets/js/date-time/bootstrap-timepicker.min.js"></script>
</body>
</html>
