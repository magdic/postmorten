
<?php include("funct.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Custom Page - Save Json</title>
	<meta charset="UTF-8">
	<meta name="description" content="" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<script type="text/javascript" src="js/prettify.js"></script>                                   
	<script type="text/javascript" src="js/kickstart.js"></script>                                  
	<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />     
</head>
<body>
	<a id="top-of-page"></a><div id="wrap" class="clearfix">
	<div class="col_12">
	<!-- <ul class="tabs-left">
		<li><a href="#maintab">Tasks</a></li>
		<li><a href="#finishedtab">finishedtasks</a></li>
		<li><a href="#thrashtab">thrash</a></li>
	</ul> -->

	<div id="maintab" class="tab-content">
	<h2>Add Timeline</h2>

		<p><?php showinputform("action.php"); ?></p>

		<p>
			<h2>Timelines</h2>
				<?php listtasks($json_a,"open","table"); ?></p>

	</div><!-- tab div -->


	<div class="tab-content" id="finishedtab">

	<h2>finishedtasks</h2>
	<?php listtasks($json_a,"closed","table"); ?>
</div> <!-- tab div -->

<div class="tab-content" id="thrashtab">
<h2>thrash</h2>

<?php listtasks($json_a,"deleted","table"); ?>

</div> <!-- tab div -->

</div><!--col_12 -->

<div class="col_6">

<h2>info</h2><p>infotext</p><p>".$projectname." - ".$projectversion."</p>

</div> <!-- col_ -->

	</div> <!-- col_ -->

</div><!-- div wrap -->

</body>
</html>