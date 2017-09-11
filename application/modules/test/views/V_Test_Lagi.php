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
/*$statistic_today 		= array();
$statistic_yesterday 	= array();
$statistic_lastweek 	= array();
$statistic_lastmonth 	= array();

for ($i=0; $i < $count_today ; $i++) 
{ 
	$statistic_today[]	 = $i;
}

for ($i=0; $i < $count_yesterday ; $i++) 
{ 
	$statistic_yesterday[]	 = $i;
}

for ($i=0; $i < $count_lastweek ; $i++) 
{ 
	$statistic_lastweek[]	 = $i;
}

for ($i=0; $i < $count_lastmonth ; $i++) 
{ 
	$statistic_lastmonth[]	 = $i;
}

print_r($statistic_today) ; 
echo "<br>";
echo "<br>";
print_r($statistic_yesterday) ;
echo "<br>";
echo "<br>";
print_r($statistic_lastweek) ;
echo "<br>";
echo "<br>";
print_r($statistic_lastmonth) ; */

?>