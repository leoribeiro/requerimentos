<?PHP

// 
//  ajax_calendar_part1.phps
//  Ryboe Ajax Calendar
//
//	Version: 0.02
//
//	This is the PHP rendering portion of the calendar
//	
//  
//  Author: Sean Sullivan
//  Website: www.ryboe.com
//  Copyright 2008 Sean Sullivan under the GNU GENERAL PUBLIC [GPL] LICENSE: http://www.gnu.org/licenses/lgpl.txt
//

function MesPortugues(){
	switch (date("m")) {
	        case "01":    $mes = Janeiro;     break;
	        case "02":    $mes = Fevereiro;   break;
	        case "03":    $mes = Março;       break;
	        case "04":    $mes = Abril;       break;
	        case "05":    $mes = Maio;        break;
	        case "06":    $mes = Junho;       break;
	        case "07":    $mes = Julho;       break;
	        case "08":    $mes = Agosto;      break;
	        case "09":    $mes = Setembro;    break;
	        case "10":    $mes = Outubro;     break;
	        case "11":    $mes = Novembro;    break;
	        case "12":    $mes = Dezembro;    break; 
	 }
	return $mes;
}

function isAjax() {
 return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
     $_SERVER ['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest';
}

if(isAjax() && isset($_POST['month']))
{
	$month = $_POST['month'];
	$year = !isset($_POST['year']) ? date('Y', $current_time) : $_POST['year'];
	die(getCalendar($month,$year));
}

// Assign variables for the break down of today -- day, month and year
$month = date('m', time());
$year = date('Y', time());
$calendar = getCalendar($month,$year);

function getCalendar($month,$year)
{
	// Use the PHP time() function to find out the timestamp for the current time
	$current_time = time();
	
	// Get the first day of the month
	$month_start = mktime(0,0,0,$month, 1, $year); 
	
	// Get the name of the month
	$month_name = date('F', $month_start); 
	$mes=array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
	//$month_name =  $mes[$month_name];
	
	// Figure out which day of the week the month starts on.
	$first_day = date('D', $month_start);
	
	// Assign an offset to decide which number of day of the week the month starts on.
	switch($first_day)
	{
	case "Dom":
		$offset = 0;
		break;
	case "Seg":
		$offset = 1;
		break;
	case "Ter":
		$offset = 2;
		break;
	case "Qua":
		$offset = 3;
		break;
	case "Qui":
		$offset = 4;
		break;
	case "Sex":
		$offset = 5;
		break;
	case "Sab":
		$offset = 6;
		break;
	} 
	
	// determine how many days were in last month.
	//	Note: The cal_days_in_month() function returns the number of days in a month for the specified year and calendar.
	//  Gregorian Calendar: http://en.wikipedia.org/wiki/Gregorian_calendar
	//  Define this using the constant: CAL_GREGORIAN
	if($month == 1)
		$num_days_last = cal_days_in_month(CAL_GREGORIAN, 12, ($year -1));
	else
		$num_days_last = cal_days_in_month(CAL_GREGORIAN, ($month - 1), $year);
	
	// determine how many days are in the this month.
	$num_days_current = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
	
	// Count through the days of the current month -- building an array
	for($i = 0; $i < $num_days_current; $i++)
	{
		$num_days_array[] = $i+1;
	} 
	
	// Count through the days of last month -- building an array
	for($i = 0; $i < $num_days_last; $i++)
	{
		$num_days_last_array[] = '';
	}
	
	if($offset > 0){ 
		$offset_correction = array_slice($num_days_last_array, -$offset, $offset);
		$new_count = array_merge($offset_correction, $num_days_array);
		$offset_count = count($offset_correction);
	}
	else
	{ 
		$new_count = $num_days_array;
	}
	
	// How many days do we now have?
	$current_num = count($new_count); 
	
	// Our display is to be 35 cells so if we have less than that we need to dip into next month
	if($current_num > 35)
	{
		$num_weeks = 6;
		$outset = (42 - $current_num);
	}
	else if($current_num < 35)
	{
		$num_weeks = 5;
		$outset = (35 - $current_num);
	}
	if($current_num == 35)
	{
		$num_weeks = 5;
		$outset = 0;
	}
	
	// Outset Correction
	for($i = 1; $i <= $outset; $i++)
	{
		$new_count[] = '';
	}
	
	// Now let's "chunk" the $new_count array
	// into weeks. Each week has 7 days
	// so we will array_chunk it into 7 days.
	$weeks = array_chunk($new_count, 7);
	
	// Start the output buffer so we can output our calendar nicely
	ob_start();
	
	$last_month = $month == 1 ? 12 : $month - 1;
	$next_month = $month == 12 ? 1 : $month + 1;
	
	// Build the heading portion of the calendar table
	echo <<<EOS
	<table id="calendar">
	<tr>
		<td><a href="#" class="monthnav" onclick="getPrevMonth();return false;">&laquo; Prev</a></td>
		<td colspan=5 class="month">$month_name $year</b></td>
		<td><a href="#" class="monthnav" onclick="getNextMonth();return false;">Next &raquo;</a></td>
	</tr>
	<tr class="daynames"> 
		<td>Domingo</td><td>Segunda</td><td>Terça</td><td>Quarta</td><td>Quinta</td><td>Sexta</td><td>Sábado</td>
	</tr>
EOS;
	
	foreach($weeks AS $week){
		echo '<tr class="week">'; 
		foreach($week as $day)
		{
			if($day == date('d', $current_time) && $month == date('m', $current_time) && $year == date('Y', $current_time))
				echo '<td class="today">'.$day.'</td>';
			else
				echo '<td class="days">'.$day.'</td>';
		}
		echo '</tr>';
	}
	
	echo '</table>';
	
	return ob_get_clean();
}
?>

<html>
<head>
<meta charset="UTF-8" />
<link href="./calendar.css" rel="stylesheet" type="text/css">
<script src="./prototype.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
	var current_month = <?PHP echo @$month ?>;
	var current_year = <?PHP echo @$year ?>;
	
	function getPrevMonth()
	{
		if(current_month == 1)
		{
			current_month = 12;
			current_year = current_year - 1;
		}
		else
		{
			current_month = current_month - 1;
		}
		params = 'month='+current_month+'&year='+current_year;
		new Ajax.Updater('calendar_wrapper',window.location.pathname,{method:'post',parameters: params});
	}
		function getNextMonth()
		{
			if(current_month == 12)
			{
				current_month = 1;
				current_year = current_year + 1;
			}
			else
			{
				current_month = current_month + 1;
			}
			params = 'month='+current_month+'&year='+current_year;
			new Ajax.Updater('calendar_wrapper',window.location.pathname,{method:'post',parameters: params});
		}
</script>
</head>

<body>
<div id="calendar_wrapper"><?PHP echo @$calendar ?></div>
</body>
</html>
