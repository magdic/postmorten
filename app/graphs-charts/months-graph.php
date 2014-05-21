		<!-- MONTHS  -->
						<div class="widget-box transparent">
					<div class="widget-header widget-header-flat">
						<h4 class="lighter">
							<i class="icon-bar-chart"></i>
							Affluency of Projects by Month
						</h4>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="icon-chevron-up"></i>
							</a>
						</div>
					</div>

					<div class="widget-body"><div class="widget-body-inner" style="display: block;">
						<div class="widget-main padding-4">
	 
							<div id="projectsChartbyMonth" style="height: 100%"></div>

									<script type="text/javascript">
									$(function () {
									        $('#projectsChartbyMonth').highcharts({
									            chart: {
									                type: 'column'
									            },
									            title: {
									                text: 'Postmorten App'
									            },
									            subtitle: {
									                text: 'Projects by Month'
									            },
									            xAxis: {
									                categories: [
									                            <?php 
									                                $test = mysql_query("SELECT SUBSTRING(startDateP, 6, 2) AS month, COUNT(*) AS qty FROM timeProject GROUP BY month HAVING COUNT(*)");
									                                //split all fields fom the correct row into an associative array
									                                while($rowie = mysql_fetch_array($test)) {                
									                                if($rowie["month"] == '01'){
									                                	echo "'Jan',";
									                                }
									                                if($rowie["month"] == '02'){
									                                	echo "'Feb',";
									                                }
									                                if($rowie["month"] == '03'){
									                                	echo "'Mar',";
									                                }
									                                if($rowie["month"] == '04'){
									                                	echo "'Apr',";
									                                }
									                                if($rowie["month"] == '05'){
									                                	echo "'May',";
									                                }
									                                if($rowie["month"] == '06'){
									                                	echo "'Jun',";
									                                }
									                                if($rowie["month"] == '07'){
									                                	echo "'Jul',";
									                                }
									                                if($rowie["month"] == '08'){
									                                	echo "'Aug',";
									                                }
									                                if($rowie["month"] == '09'){
									                                	echo "'Sep',";
									                                }
									                                if($rowie["month"] == '10'){
									                                	echo "'Oct',";
									                                }
									                                if($rowie["month"] == '11'){
									                                	echo "'Nov',";
									                                }
									                                if($rowie["month"] == '12'){
									                                	echo "'Dec',";
									                                }
									                               
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
									                        this.x +': '+ this.y +' Projects';
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
									                name: 'Monthy Average',
									                data: [
									                    <?php 

									                    $test = mysql_query("SELECT SUBSTRING(startDateP, 6, 2) AS month, COUNT(*) AS qty FROM timeProject GROUP BY month HAVING COUNT(*)");
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