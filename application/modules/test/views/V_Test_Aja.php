<?php

// ========== BDS ==========
$error_bds 	= array();

// =---= TODAY =---=
foreach ($today_bds as $field_today_bds)
{
	$hour_bds[]				= substr($field_today_bds->JAM, 0,2);
	$minute_bds[]			= substr($field_today_bds->JAM, 2,2);

	$success_today_bds[]		= $field_today_bds->SUKSES;
	$ps_success_today_bds[]		= number_format(($field_today_bds->SUKSES/$field_today_bds->SUM_ALL)*100,2,'.','.');
}

$count_today_bds 	= count($success_today_bds)-1;

// =---= YESTERDAY =---=
foreach ($yesterday_bds as $field_yesterday_bds)
{
	$success_yesterday_bds[]		= $field_yesterday_bds->SUKSES;
	$ps_success_yesterday_bds[]		= number_format(($field_yesterday_bds->SUKSES/$field_yesterday_bds->SUM_ALL)*100,2,'.','.');
}

$count_yesterday_bds 	= count($success_yesterday_bds)-1;

if ($count_yesterday_bds - $count_today_bds < 0)
{
	$success_yesterday_bds_1 	= end($success_yesterday_bds);
	$ps_success_yesterday_bds_1	= end($ps_success_yesterday_bds);
}
else
{
	$success_yesterday_bds_1 	= $success_yesterday_bds[$count_today_bds-1];
	$ps_success_yesterday_bds_1	= $ps_success_yesterday_bds[$count_today_bds-1];
}

// =---= LAST WEEK =---=
foreach ($lastweek_bds as $field_lastweek_bds)
{
	$success_lastweek_bds[]			= $field_lastweek_bds->SUKSES;
	$ps_success_lastweek_bds[]		= number_format(($field_lastweek_bds->SUKSES/$field_lastweek_bds->SUM_ALL)*100,2,'.','.');
}

$count_lastweek_bds 		= count($success_lastweek_bds)-1;

if ($count_lastweek_bds - $count_today_bds < 0)
{
	$success_lastweek_bds_1 	= end($success_lastweek_bds);
	$ps_success_lastweek_bds_1	= end($ps_success_lastweek_bds);
}
else
{
	$success_lastweek_bds_1 	= $success_lastweek_bds[$count_today_bds-1];
	$ps_success_lastweek_bds_1	= $ps_success_lastweek_bds[$count_today_bds-1];
}

// =---= LAST MONTH =---=
foreach ($lastmonth_bds as $field_month_bds)
{
	$success_lastmonth_bds[]		= $field_month_bds->SUKSES;
	$ps_success_lastmonth_bds[]		= number_format(($field_month_bds->SUKSES/$field_month_bds->SUM_ALL)*100,2,'.','.');
}

$count_lastmonth_bds 	= count($success_lastmonth_bds)-1;

if ($count_lastmonth_bds - $count_today_bds < 0)
{
	$success_lastmonth_bds_1	= end($success_lastmonth_bds);
	$ps_success_lastmonth_bds_1	= end($ps_success_lastmonth_bds);
}
else
{
	$success_lastmonth_bds_1	= $success_lastmonth_bds[$count_today_bds-1];
	$ps_success_lastmonth_bds_1	= $ps_success_lastmonth_bds[$count_today_bds-1];
}

foreach ($threshold_bds as $field_threshold_bds) 
{
	$bot_thres_bds 	= $field_threshold_bds->BOT_THRES;
	$top_thres_bds 	= $field_threshold_bds->TOP_THRES;
}

// =---= STATISTIC DATA =---=
for ($i=0; $i < $count_today_bds ; $i++) 
{ 
	$growth_success_today_bds 		= $success_today_bds[$i+1] - $success_today_bds[$i];
	$growth_success_yesterday_bds 	= $success_yesterday_bds[$i+1] - $success_yesterday_bds[$i];
	$growth_success_lastweek_bds 	= $success_lastweek_bds[$i+1] - $success_lastweek_bds[$i];
	$growth_success_lastmonth_bds 	= $success_lastmonth_bds[$i+1] - $success_lastmonth_bds[$i];


	$today_success_bds[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour_bds[$i+1].",".$minute_bds[$i+1]."),".$growth_success_today_bds."]";

	$yesterday_success_bds[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour_bds[$i+1].",".$minute_bds[$i+1]."),".$growth_success_yesterday_bds."]";

	$lastweek_success_bds[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour_bds[$i+1].",".$minute_bds[$i+1]."),".$growth_success_lastweek_bds."]";

	$lastmonth_success_bds[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour_bds[$i+1].",".$minute_bds[$i+1]."),".$growth_success_lastmonth_bds."]";
}

for ($i=0; $i < $count_today_bds ; $i++) 
{ 
	if($success_today_bds[$i] == 0 || $success_lastweek_bds[$i] == 0)
	{
		$variance_bds 	= 'null';
	}
	else if(empty($success_today_bds[$i]) || empty($success_lastweek_bds[$i]))
	{
		$variance_bds 	= (($success_today_bds[$i] - $success_lastweek_bds[$i]) / $success_lastweek_bds[$i]) * 100;
	}
	else if($variance_bds < $bot_thres_bds)
	{
		$error_bds[]	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour_bds[$i+1].",".$minute_bds[$i+1]."),null]";
	}
	else
	{
		$error_bds[]	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour_bds[$i+1].",".$minute_bds[$i+1]."),".$variance_bds."]";
	}	
}

print_r($today_success_bds);

// =---= CONDITION =---=
if ($variance_bds < $bot_thres_bds) 
{
	$condition_bds 	= "<img src='".asset_url()."indicator/green.gif'>";
}
else if ($variance_bds >= $bot_thres_bds && $variance_bds < $top_thres_bds)
{
	$condition_bds 	= "<img src='".asset_url()."indicator/orange.gif'>";
}
else 
{
	$condition_bds 	= "<img src='".asset_url()."indicator/red.gif'>";
}

?>

<div class="slide">	

	<!-- ========== BDS CONTENT ========== -->
	<div class="slider-item">

		<a href="<?=base_url()?>channel/bds/statistic/success" oncontextmenu="return false" class="prevent">

			<div class="row" style="zoom:90%">

				<div class="col-lg-3">

					<div class="ibox float-e-margins">

						<div class="ibox-title">
							<span class="pull-right text-info">
								<?=date('l, d-m-Y')?>
							</span>
							<h5 class="text-info">Today</h5>	
						</div>

						<div class="ibox-content">
							<h2 class="no-margins text-info">
								<?=number_format(end($success_today_bds))?>
								<div class="stat-percent text-info"><?=end($ps_success_today_bds)?>%</div>
							</h2>
							<div class="stat-percent text-info"></div>
							<br>
							<div class="stat-percent text-info"></div>
							<small></small>
						</div>

					</div>

				</div>

				<div class="col-lg-3">

					<div class="ibox float-e-margins">

						<div class="ibox-title">
							<span class="pull-right text-success">
								<?=date("l, d-m-Y", mktime(0,0,0, date("m"), date("j")-1, date("y")))?>
							</span>
							<h5 class="text-success">Yesterday</h5>	
						</div>

						<div class="ibox-content">
							<h2 class="no-margins text-success">
								<?=number_format($success_yesterday_bds_1)?>
								<div class="stat-percent text-success"><?=$ps_success_yesterday_bds_1?>%</div>
							</h2>
							<div class="stat-percent text-info"></div>
							<br>
							<div class="stat-percent text-info"></div>
							<small></small>
						</div>

					</div>

				</div>

				<div class="col-lg-3">

					<div class="ibox float-e-margins">

						<div class="ibox-title">
							<span class="pull-right text-info">
								<?=date("l, d-m-Y", mktime(0,0,0, date("m"), date("j")-7, date("y")));?>
							</span>
							<h5 class="text-info">Last Week</h5>	
						</div>

						<div class="ibox-content">
							<h2 class="no-margins text-info">
								<?=number_format($success_lastweek_bds_1)?>
								<div class="stat-percent text-info"><?=$ps_success_lastweek_bds_1?>%</div>
							</h2>
							<div class="stat-percent text-info"></div>
							<br>
							<div class="stat-percent text-info"></div>
							<small></small>
						</div>

					</div>

				</div>

				<div class="col-lg-3">

					<div class="ibox float-e-margins">

						<div class="ibox-title">
							<span class="pull-right text-success">
								<?=date("l, d-m-Y", mktime(0,0,0, date("m")-1, date("j"), date("y")))?>
							</span>
							<h5 class="text-success">Last Month</h5>	
						</div>

						<div class="ibox-content">
							<h2 class="no-margins text-success">
								<?=number_format($success_lastmonth_bds_1)?>
								<div class="stat-percent text-success"><?=$ps_success_lastmonth_bds_1?>%</div>
							</h2>
							<div class="stat-percent text-info"></div>
							<br>
							<div class="stat-percent text-info"></div>
							<small></small>
						</div>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-lg-12">

					<div class="ibox float-e-margins">

						<div class="ibox-title text-center">
							<span class="pull-right text-success"><?=$condition_bds?></span>
							<span class="text-success" style="font-size: 15px;">BDS Transaction</span>
						</div>

						<div class="ibox-content text-center">

							<div id='bds_transaction'></div>

						</div>

					</div>

				</div>

			</div>

		</a>

	</div>

</div>

<script type="text/javascript">

	Highcharts.Pointer.prototype.reset = function () {
		return undefined;
	};


	Highcharts.Point.prototype.highlight = function (event) {
		this.onMouseOver(); 
		this.series.chart.tooltip.refresh(this); 
		this.series.chart.xAxis[0].drawCrosshair(event, this); 
	};


	function syncExtremes(e) {
		var thisChart = this.chart;

		if (e.trigger !== 'syncExtremes') { 
			Highcharts.each(Highcharts.charts, function (chart) {
				if (chart !== thisChart) {
					if (chart.xAxis[0].setExtremes) { 
						chart.xAxis[0].setExtremes(e.min, e.max, undefined, false, { trigger: 'syncExtremes' });
					}
				}
			});
		}
	}

	// ========== BDS ==========
	$('#bds_transaction').bind('mousemove touchmove touchstart', function (e) {
		var chart,
		point,
		i,
		event;

		for (i = 0; i < Highcharts.charts.length; i = i + 1) {
			chart = Highcharts.charts[i];
			event = chart.pointer.normalize(e.originalEvent); 
			point = chart.series[0].searchPoint(event, true); 

			if (point) {
				point.highlight(e);
			}
		}
	});

	$('<div class="chart">')
	.appendTo('#bds_transaction')
	.highcharts({
		chart: {
			marginLeft: 40, 
			spacingTop: 20,
			spacingBottom: 20,
			zoomType: 'x',
			setSize: null,
			height: '60px'
		},

		title: {
			text: null,
			align: 'left',
			margin: 0,
			x: 30
		},

		credits: {
			enabled: false
		},

		legend: {
			enabled: false,
			align: 'left',
			verticalAlign: 'top',
			x:50,
			y:5,
			floating: true,
			itemMarginTop: -10,
			itemMarginBottom: -20,
			itemStyle:
			{
				"color": "#000000", 
				"cursor": "pointer", 
				"fontSize": "12px",
				"fontFamily": "Times New Romans"
			}
		},

		exporting: {
			enabled: false
		},

		xAxis: {
			type:'datetime',
			events: {
				setExtremes: syncExtremes
			},
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'Times New Romans'
				}
			},
			crosshair: {
				enabled: true
			},
			visible: false
		},

		yAxis: {
			title: {
				text: null
			},
			visible: false
		},

		tooltip: {
			borderRadius:1,
			borderWidth:1,
			split:false,
			xDateFormat: '%H:%M',
			followPointer: false,
			valueSuffix: '%',
			valueDecimals: 2,
			style:
			{
				"color": "#000000", 
				"cursor": "default", 
				"fontSize": "13px", 
				"padding": "8px",
				"fontFamily": "Times New Romans"
			}
		},

		plotOptions: {
			series: 
			{
				animation: {
					duration: 3000
				},
				lineWidth: 1,
				borderRadius: 0
			},
			spline: {
				marker: {
					radius: 4
				},
				states: {
					hover: {
						lineWidth: 1
					}
				},
				threshold: null
			},
		},

		series: [{
			data: [<?=trim(implode(",",$error_bds))?>],
			zones: [
			{
				value: <?=$top_thres_bds-0.5?>,
				color: '#ffae19'
			},
			{
				color: '#e50000'
			}
			],
			name: 'Variance',
			type: 'spline'
		}]
	});

	$('<div class="chart">')
	.appendTo('#bds_transaction')
	.highcharts({
		chart: {
			marginLeft: 40, 
			spacingTop: 20,
			spacingBottom: 20,
			zoomType: 'x',
			setSize: null
		},

		title: {
			text: null,
			align: 'left',
			margin: 0,
			x: 30
		},

		credits: {
			enabled: false
		},

		legend: {
			enabled: true,
			floating: true,
			itemMarginTop: -10,
			itemMarginBottom: -20,
			itemStyle:
			{
				"color": "#000000", 
				"cursor": "pointer", 
				"fontSize": "12px",
				"fontFamily": "Times New Romans"
			}
		},

		exporting: {
			enabled: false
		},

		xAxis: {
			type:'datetime',
			events: {
				setExtremes: syncExtremes
			},
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'Times New Romans'
				}
			},
			crosshair: {
				enabled: true
			}
		},

		yAxis: {
			title: {
				text: null
			}
		},

		tooltip: {
			borderRadius:1,
			borderWidth:1,
			split:true,
			xDateFormat: '%H:%M',
			followPointer: false,
			style:
			{
				"color": "#000000", 
				"cursor": "default", 
				"fontSize": "13px", 
				"padding": "8px",
				"fontFamily": "Times New Romans"
			}
		},

		plotOptions: {
			series: 
			{
				animation: {
					duration: 3000
				},
				lineWidth: 2,
				borderRadius: 0
			},
			spline: {
				marker: {
					radius: 2
				},
				states: {
					hover: {
						lineWidth: 2
					}
				},
				threshold: null
			}
		},
		
		series: [
		{
			data: [<?=trim(implode(",",$today_success_bds))?>],
			name: 'Today',
			type: 'spline',
			color: '#0000ff',
			fillOpacity: 0.3
		},
		{
			data: [<?=trim(implode(",",$yesterday_success_bds))?>],
			name: 'Yesterday',
			type: 'spline',
			color: '#040a33',
			fillOpacity: 0.3
		},
		{
			data: [<?=trim(implode(",",$lastweek_success_bds))?>],
			name: 'Last Week',
			type: 'spline',
			color: '#43cd80',
			fillOpacity: 0.3
		},
		{
			data: [<?=trim(implode(",",$lastmonth_success_bds))?>],
			name: 'Last Month',
			type: 'spline',
			color: '#ee6a50',
			fillOpacity: 0.3
		}
		]
	});
</script>