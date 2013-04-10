<?php
$uptime = file_get_contents('/proc/uptime');
$uptime = explode(' ', $uptime);
$uptime = $uptime[0];

$days_up = floor($uptime/24/3600);
$hours_up = floor(($uptime - $days_up*24*3600)/3600);
$minutes_up = floor(($uptime - $days_up*24*3600 - $hours_up*3600)/60);
$seconds_up = floor($uptime - $days_up*24*3600 - $hours_up*3600 - $minutes_up*60);

$hours_up_pl = ($hours_up == 1) ? '' : 's';
$minutes_up_pl = ($minutes_up == 1) ? '' : 's';
$seconds_up_pl = ($seconds_up == 1) ? '' : 's';
?>
<h2>Uptime</h2>
<p><span class="bigtext"><?php echo $days_up; ?></span> <span class="medtext">days</span></p>
<p><span class="smalltext"><?php echo $hours_up; ?> hour<?php echo $hours_up_pl; ?>, <?php echo $minutes_up; ?> minute<?php echo $minutes_up_pl; ?>, <?php echo $seconds_up; ?> second<?php echo $seconds_up_pl; ?></span></p>
