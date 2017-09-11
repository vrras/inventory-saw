<?php

$error 	= array();

// =---= TODAY =---=
foreach ($today as $field_today)
{
	$hour[]				= substr($field_today->JAM, 0,2);
	$minute[]			= substr($field_today->JAM, 2,2);

	$success_today[]		= $field_today->GAGAL;
	$ps_success_today[]		= number_format(($field_today->GAGAL/$field_today->SUM_ALL)*100,2,'.','.');
}

$count_today 	= count($success_today)-1;

// =---= YESTERDAY =---=
foreach ($yesterday as $field_yesterday)
{
	$success_yesterday[]		= $field_yesterday->GAGAL;
	$ps_success_yesterday[]		= number_format(($field_yesterday->GAGAL/$field_yesterday->SUM_ALL)*100,2,'.','.');
}

$count_yesterday 	= count($success_yesterday)-1;

if ($count_yesterday - $count_today < 0)
{
	$success_yesterday_1 	= end($success_yesterday);
	$ps_success_yesterday_1	= end($ps_success_yesterday);
}
else
{
	$success_yesterday_1 	= $success_yesterday[$count_today-1];
	$ps_success_yesterday_1	= $ps_success_yesterday[$count_today-1];
}

// =---= LAST WEEK =---=
foreach ($lastweek as $field_lastweek)
{
	$success_lastweek[]			= $field_lastweek->GAGAL;
	$ps_success_lastweek[]		= number_format(($field_lastweek->GAGAL/$field_lastweek->SUM_ALL)*100,2,'.','.');
}

$count_lastweek 		= count($success_lastweek)-1;

if ($count_lastweek - $count_today < 0)
{
	$success_lastweek_1 	= end($success_lastweek);
	$ps_success_lastweek_1	= end($ps_success_lastweek);
}
else
{
	$success_lastweek_1 	= $success_lastweek[$count_today-1];
	$ps_success_lastweek_1	= $ps_success_lastweek[$count_today-1];
}

// =---= LAST MONTH =---=
foreach ($lastmonth as $field_month)
{
	$success_lastmonth[]		= $field_month->GAGAL;
	$ps_success_lastmonth[]		= number_format(($field_month->GAGAL/$field_month->SUM_ALL)*100,2,'.','.');
}

$count_lastmonth 	= count($success_lastmonth)-1;

if ($count_lastmonth - $count_today < 0)
{
	$success_lastmonth_1	= end($success_lastmonth);
	$ps_success_lastmonth_1	= end($ps_success_lastmonth);
}
else
{
	$success_lastmonth_1	= $success_lastmonth[$count_today-1];
	$ps_success_lastmonth_1	= $ps_success_lastmonth[$count_today-1];
}

foreach ( $threshold as $field_threshold) 
{
	$bot_thres 	= $field_threshold->BOT_THRES;
	$top_thres 	= $field_threshold->TOP_THRES;
}

// =---= STATISTIC DATA =---=
for ($i=0; $i < $count_today ; $i++) 
{ 
	$growth_success_today 		= $success_today[$i+1] - $success_today[$i];
	$growth_success_yesterday 	= $success_yesterday[$i+1] - $success_yesterday[$i];
	$growth_success_lastweek 	= $success_lastweek[$i+1] - $success_lastweek[$i];
	$growth_success_lastmonth 	= $success_lastmonth[$i+1] - $success_lastmonth[$i];

	if($success_today[$i] == 0 || $success_lastweek[$i] == 0)
	{
		$variance 	= 'null';
	}
	else
	{
		$variance 	= (($success_today[$i] - $success_lastweek[$i]) / $success_lastweek[$i]) * 100;
	}

	$today_success[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour[$i+1].",".$minute[$i+1]."),".$growth_success_today."]";

	$yesterday_success[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour[$i+1].",".$minute[$i+1]."),".$growth_success_yesterday."]";

	$lastweek_success[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour[$i+1].",".$minute[$i+1]."),".$growth_success_lastweek."]";

	$lastmonth_success[] 	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour[$i+1].",".$minute[$i+1]."),".$growth_success_lastmonth."]";

	$error[]	= "[Date.UTC(".date("Y,m,d", mktime(0,0,0, date("m")-1, date("j"), date("y"))).",".$hour[$i+1].",".$minute[$i+1]."),".$variance."]";
}

// =---= CONDITION =---=
if ($variance < $bot_thres) 
{
	$condition 	= "<img src='".asset_url()."indicator/green.gif'>";
}
else if ($variance >= $bot_thres && $variance < $top_thres)
{
	$condition 	= "<img src='".asset_url()."indicator/orange.gif'>";
}
else 
{
	$condition 	= "<img src='".asset_url()."indicator/red.gif'>";
}
?>

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
					<?=number_format(end($success_today))?>
					<div class="stat-percent text-info"><?=end($ps_success_today)?>%</div>
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
					<?=number_format($success_yesterday_1)?>
					<div class="stat-percent text-success"><?=$ps_success_yesterday_1?>%</div>
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
					<?=number_format($success_lastweek_1)?>
					<div class="stat-percent text-info"><?=$ps_success_lastweek_1?>%</div>
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
					<?=number_format($success_lastmonth_1)?>
					<div class="stat-percent text-success"><?=$ps_success_lastmonth_1?>%</div>
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
				<span class="pull-right text-success"><?=$condition?></span>
				<span class="text-success" style="font-size: 15px;"><?=$title?></span>
			</div>

			<div class="ibox-content text-center">

				<div id='<?=strtolower(str_replace(" ", "_", $title))?>'></div>

			</div>

		</div>

	</div>

</div>

<script type="text/javascript">

	$('#<?=strtolower(str_replace(" ", "_", $title))?>').bind('mousemove touchmove touchstart', function (e) {
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

	$('<div class="chart">')
	.appendTo('#<?=strtolower(str_replace(" ", "_", $title))?>')
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
			data: [<?=trim(implode(",",$error))?>],
			zones: [
			{
				value: <?=$top_thres-0.5?>,
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
	.appendTo('#<?=strtolower(str_replace(" ", "_", $title))?>')
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
			data: [<?=trim(implode(",",$today_success))?>],
			name: 'test 1',
			type: 'spline',
			color: '#00c5cd'
		},
		{
			data: [<?=trim(implode(",",$yesterday_success))?>],
			name: 'test 1',
			type: 'spline',
			color: '#9a32cd'
		},
		{
			data: [<?=trim(implode(",",$lastweek_success))?>],
			name: 'test 1',
			type: 'spline',
			color: '#43cd80'
		},
		{
			data: [<?=trim(implode(",",$lastmonth_success))?>],
			name: 'test 1',
			type: 'spline',
			color: '#ee6a50'
		}
		]
	});
</script>