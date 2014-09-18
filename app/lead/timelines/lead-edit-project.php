<?php 
//allow sessions to be passed so we can see if the user is logged in
//session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php";




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
        <link rel="stylesheet" href="../../assets/css/chosen.css">
    	<link rel="stylesheet" href="../../assets/css/jquery-ui-1.10.3.custom.min.css">

        <!-- ace settings handler -->
        <link rel="stylesheet" href="../../assets/css/datepicker.css" />
        <script src="../../assets/js/ace-extra.min.js"></script>
        <script src='../../assets/js/jquery-2.0.3.min.js'></script>
</head>
<body>
<div class="panel-body">
<form action="../../../controllers/lead-edit-project.php" method="post" class="form-horizontal" role="form">
    <input type="hidden" id="idFromProject" name="idFromProject" value="<?php echo $idProject; ?>" readonly="">
    <input type="hidden" id="idFromProject" name="id" value="<?php echo $id; ?>" readonly="">
    <fieldset>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Project Start Date: </label>
            <div class="col-sm-8">
                <input value="<?php echo $date; ?>" type="text" id="id-date-picker-1 startDate" name="startDate" placeholder="YYYY,MM,DD" class="col-xs-12 col-sm-10 date-picker" data-date-format="yyyy,mm,dd">
                <span class="input-group-addon">
                    <i class="icon-calendar bigger-110"></i>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Project Name:  </label>
            <div class="col-sm-8">
                <input value="<?php echo $headline; ?>" type="text" id="form-field-2 headline" name="headline" placeholder="Headline for the timeline" class="col-xs-12 col-sm-10">
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Project Description: </label>
            <div class="col-sm-8">
                <input  type="hidden" id="form-field-3" name="text" placeholder="Reference text" class="col-xs-12 col-sm-10">
                 <div class="wysiwyg-editor" id="editor1" contenteditable="true"><?php echo $text; ?></div>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-4"> Media URL: </label>
            <div class="col-sm-8">
                <input value="<?php echo $media; ?>" type="text" id="form-field-4 media" name="media" placeholder="Media URL" class="col-xs-12 col-sm-10">
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-5"> Media Credit: </label>
            <div class="col-sm-8">
                <input value="<?php echo $credit; ?>" type="text" id="form-field-5 credit" name="credit" placeholder="Credit" class="col-xs-12 col-sm-10">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-6"> Media Caption: </label>
            <div class="col-sm-8">
                <input value="<?php echo $caption; ?>" type="text" id="form-field-6 caption" name="caption" placeholder="Caption" class="col-xs-12 col-sm-10">
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

<script src="../../assets/js/date-time/bootstrap-datepicker.min.js"></script>



<!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
                window.jQuery || document.write("<script src='../../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="../../assets/js/bootstrap.min.js"></script>
        <script src="../../assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="../../assets/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="../../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../../assets/js/chosen.jquery.min.js"></script>
        <script src="../../assets/js/fuelux/fuelux.spinner.min.js"></script>
        <script src="../../assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="../../assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="../../assets/js/date-time/moment.min.js"></script>
        <script src="../../assets/js/jquery.autosize.min.js"></script>
        <script src="../../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="../../assets/js/jquery.maskedinput.min.js"></script>
        <script src="../../assets/js/bootstrap-tag.min.js"></script>
        <script src="../../assets/js/markdown/markdown.min.js"></script>
        <script src="../../assets/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="../../assets/js/jquery.hotkeys.min.js"></script>
        <script src="../../assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../../assets/js/bootbox.min.js"></script>

        <!-- ace scripts -->

        <script src="../../assets/js/ace-elements.min.js"></script>
        <script src="../../assets/js/ace.min.js"></script>

<script>
    jQuery(function($) {

        $("form").on("submit",function() {
                    wysiwygText = $("#editor1").html();
                    $("#form-field-3").val(wysiwygText);
        });


        $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                    $(this).prev().focus();
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

</body>
</html>




