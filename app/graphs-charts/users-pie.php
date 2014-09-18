<!-- USERS  -->
<div class="widget-box transparent">
					<div class="widget-header widget-header-flat">
						<h4 class="lighter">
							<i class="icon-bar-chart"></i>
							Users per Department
						</h4>

						<div class="widget-toolbar">
							<a href="#" data-action="collapse">
								<i class="icon-chevron-up"></i>
							</a>
						</div>
					</div>

					<div class="widget-body"><div class="widget-body-inner" style="display: block;">
						<div class="widget-main padding-4">
							<div id="users-pie" style="height: 100%"></div>

<script type="text/javascript">
$(function () {
    $('#users-pie').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Showing users per department Hangar'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y} ',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Users Percentage',
            data: [
            <?php 
				$test = mysql_query("SELECT department, COUNT(*) AS qty FROM users GROUP BY department HAVING COUNT(*)");
			    //split all fields fom the correct row into an associative array
			    while($rowie = mysql_fetch_array($test)) {
			    	echo "['".$rowie['department']."',".$rowie['qty']."],";
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