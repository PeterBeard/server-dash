<?php
$stats = file_get_contents('/proc/loadavg');
$stats = explode(' ', $stats);
$onem = $stats[0];
$fivem = $stats[1];
$fifteenm = $stats[2];
$numprocesses = $stats[3];
?>
{
	"oneminuteload":"<?php echo $onem; ?>",
	"fiveminuteload":"<?php echo $fivem; ?>",
    "fifteenminuteload":"<?php echo $fifteenm; ?>",
    "numberofprocesses":"<?php echo $numprocesses; ?>"
}
