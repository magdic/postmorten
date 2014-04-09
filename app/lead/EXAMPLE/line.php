<?php //connect to the database so we can check, edit, or insert data to our users table
include('../../../config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../../../config/functions.php"; ?>

<!DOCTYPE html>	
<html>
<head>
	<title>Example Chart</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<script src="highcharts.js"></script>
    <script src="exporting.js"></script>

	<style type="text/css">

	</style>

</head>
<body>

<div id="projectsChart" style="height: 270px"></div>


<script type="text/javascript">

$(function () {
        $('#projectsChart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Postmorten App'
            },
            subtitle: {
                text: 'Projects by year'
            },
            xAxis: {
                categories: [

                            <?php 
                                $test = mysql_query("SELECT SUBSTRING(startDateP, 1, 4) AS year, COUNT(*) AS qty FROM timeProject GROUP BY year HAVING COUNT(*)");
                                //split all fields fom the correct row into an associative array
                                while($rowie = mysql_fetch_array($test)) {                    
                                echo "'Year ".$rowie["year"]."',";
                                }
                            ?>

                ]
            },
            yAxis: {
                title: {
                    text: 'Qty of Projects'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true,
                        style: {
                            textShadow: '0 0 3px white, 0 0 3px white'
                        }
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Projects',
                data: [
                    <?php 

                    $test = mysql_query("SELECT SUBSTRING(startDateP, 1, 4) AS year, COUNT(*) AS qty FROM timeProject GROUP BY year HAVING COUNT(*)");
                    //split all fields fom the correct row into an associative array
                    while($rowie = mysql_fetch_array($test)) {
                    echo $rowie['qty'].',';
                     }
                 ?>
                ]
            }]
        });
    });
    

    


</script>

</body>
</html>