<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../config/functions.php";

?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome PM User | my App</title>
     <script src="//localhost:35729/livereload.js"></script>

        <!-- basic styles -->

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="../assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="../assets/css/ace.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

        <!-- overwrite -->

        <link rel="stylesheet" href="../assets/css/main.css"/>


        <!-- ace settings handler -->

        <script src="../assets/js/ace-extra.min.js"></script>

        <script src='../assets/js/jquery-2.0.3.min.js'></script>

        <script src="../assets/charts/highcharts.js"></script>
        <script src="../assets/charts/exporting.js"></script>   

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
			echo "<center>What are you doing here?</br>You are not an <b>PM User</b>!</center>";
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

                   <!--  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
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
                        <li class="active">
                            <a href="#">
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
                       <!--  <li>
                            <a href="add-timeline.php">
                                <i class="icon-plus"></i>
                                <span class="menu-text"> Add timeline feedback </span>
                            </a>
                        </li> -->
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
                            <li class="active">Dashboard</li>
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
                                        Lead Panel
                                    </h1>
                                </div><!-- /.page-header -->
                                        
                                    <?php include("../graphs-charts/year-graph.php"); ?>        

                                    <?php include("../graphs-charts/months-graph.php"); ?>  


                            </div>  

                            </div>
                        </div>
                     </div>



        <!-- <h1>Welcome PM User</h1>
        <ul>
            <li><a href="">My Profile</a></li>
            <li><a href="timelines-to-me.php">Timelines Added to Me</a></li>
            <li><a href="">Hook User to Project</a></li>
            <li><a href="../../logout.php">Log Out</a></li>
        </ul> -->




        
        <script src='../assets/js/jquery.mobile.custom.min.js'></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <script src="../assets/js/bootstrap-tag.min.js"></script>
        <script src="../assets/js/jquery.hotkeys.min.js"></script>
        <script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>

        <!-- ace scripts -->

        <script src="../assets/js/ace-elements.min.js"></script>
        <script src="../assets/js/ace.min.js"></script>


        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            jQuery(function($) {
                // $('.easy-pie-chart.percentage').each(function(){
                //     var $box = $(this).closest('.infobox');
                //     var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                //     var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                //     var size = parseInt($(this).data('size')) || 50;
                //     $(this).easyPieChart({
                //         barColor: barColor,
                //         trackColor: trackColor,
                //         scaleColor: false,
                //         lineCap: 'butt',
                //         lineWidth: parseInt(size/10),
                //         animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                //         size: size
                //     });
                // })

                $('.sparkline').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                    $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
                });




              // var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
              // var data = [
              //   { label: "social networks",  data: 38.7, color: "#68BC31"},
              //   { label: "search engines",  data: 24.5, color: "#2091CF"},
              //   { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
              //   { label: "direct traffic",  data: 18.6, color: "#DA5430"},
              //   { label: "other",  data: 10, color: "#FEE074"}
              // ]
             //  function drawPieChart(placeholder, data, position) {
             //      $.plot(placeholder, data, {
             //        series: {
             //            pie: {
             //                show: true,
             //                tilt:0.8,
             //                highlight: {
             //                    opacity: 0.25
             //                },
             //                stroke: {
             //                    color: '#fff',
             //                    width: 2
             //                },
             //                startAngle: 2
             //            }
             //        },
             //        legend: {
             //            show: true,
             //            position: position || "ne",
             //            labelBoxBorderColor: null,
             //            margin:[-30,15]
             //        }
             //        ,
             //        grid: {
             //            hoverable: true,
             //            clickable: true
             //        }
             //     })
             // }
             // drawPieChart(placeholder, data);

             /**
             we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
             so that's not needed actually.
             */
             // placeholder.data('chart', data);
             // placeholder.data('draw', drawPieChart);



              var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
              var previousPoint = null;

             //  placeholder.on('plothover', function (event, pos, item) {
             //    if(item) {
             //        if (previousPoint != item.seriesIndex) {
             //            previousPoint = item.seriesIndex;
             //            var tip = item.series['label'] + " : " + item.series['percent']+'%';
             //            $tooltip.show().children(0).text(tip);
             //        }
             //        $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
             //    } else {
             //        $tooltip.hide();
             //        previousPoint = null;
             //    }

             // });






                // var d1 = [];
                // for (var i = 0; i < Math.PI * 2; i += 0.5) {
                //     d1.push([i, Math.sin(i)]);
                // }

                // var d2 = [];
                // for (var i = 0; i < Math.PI * 2; i += 0.5) {
                //     d2.push([i, Math.cos(i)]);
                // }

                // var d3 = [];
                // for (var i = 0; i < Math.PI * 2; i += 0.2) {
                //     d3.push([i, Math.tan(i)]);
                // }


                // var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
                // $.plot("#sales-charts", [
                //     { label: "Domains", data: d1 },
                //     { label: "Hosting", data: d2 },
                //     { label: "Services", data: d3 }
                // ], {
                //     hoverable: true,
                //     shadowSize: 0,
                //     series: {
                //         lines: { show: true },
                //         points: { show: true }
                //     },
                //     xaxis: {
                //         tickLength: 0
                //     },
                //     yaxis: {
                //         ticks: 10,
                //         min: -2,
                //         max: 2,
                //         tickDecimals: 3
                //     },
                //     grid: {
                //         backgroundColor: { colors: [ "#fff", "#fff" ] },
                //         borderWidth: 1,
                //         borderColor:'#555'
                //     }
                // });


                $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('.tab-content')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    var w2 = $source.width();

                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }


                $('.dialogs,.comments').slimScroll({
                    height: '300px'
                });


                //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
                //so disable dragging when clicking on label
                var agent = navigator.userAgent.toLowerCase();
                if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
                  $('#tasks').on('touchstart', function(e){
                    var li = $(e.target).closest('#tasks li');
                    if(li.length == 0)return;
                    var label = li.find('label.inline').get(0);
                    if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
                });

                $('#tasks').sortable({
                    opacity:0.8,
                    revert:true,
                    forceHelperSize:true,
                    placeholder: 'draggable-placeholder',
                    forcePlaceholderSize:true,
                    tolerance:'pointer',
                    stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                        $(ui.item).css('z-index', 'auto');
                    }
                    }
                );
                $('#tasks').disableSelection();
                $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
                    if(this.checked) $(this).closest('li').addClass('selected');
                    else $(this).closest('li').removeClass('selected');
                });


            })
        </script>
		 <?php

		//make sure you close the check if their online
		}

		?>
    </body>
</html>
