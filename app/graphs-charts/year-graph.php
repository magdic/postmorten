<div class="widget-box transparent">
					<div class="widget-header widget-header-flat">
						<h4 class="lighter">
							<i class="icon-bar-chart"></i>
							Affluency of Projects by Year
						</h4>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="icon-chevron-up"></i>
							</a>
						</div>
					</div>

					<div class="widget-body"><div class="widget-body-inner" style="display: block;">
						<div class="widget-main padding-4">
							<div id="projectsChart" style="height: 100%"></div>

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
									                                echo "'".$rowie["year"]."',";
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
									                enabled: true,
									                formatter: function() {
									                    return '<b>'+ this.series.name +'</b><br/>'+
									                        this.x +': '+ this.y +' projects';
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
									                name: 'Year Average',
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
						</div><!-- /widget-main -->
				</div>
			  </div><!-- /widget-body -->
			</div><!-- /widget-box -->	