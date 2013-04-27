<?php
$uptime = file_get_contents('/proc/uptime');
$uptime = explode(' ', $uptime);
$uptime = $uptime[0];

$days_up = floor($uptime/24/3600);
$hours_up = floor(($uptime - $days_up*24*3600)/3600);
$minutes_up = floor(($uptime - $days_up*24*3600 - $hours_up*3600)/60);
$seconds_up = floor($uptime - $days_up*24*3600 - $hours_up*3600 - $minutes_up*60);

?>
{
	"days":"<?php echo $days_up; ?>",
    "hours":"<?php echo $hours_up; ?>",
    "minutes":"<?php echo $minutes_up; ?>",
    "seconds":"<?php echo $seconds_up; ?>"
}
