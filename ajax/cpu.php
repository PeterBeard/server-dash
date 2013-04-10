<?php
$stats = file_get_contents('/proc/loadavg');
$stats = explode(' ', $stats);
$onem = $stats[0];
$fivem = $stats[1];
$fifteenm = $stats[2];
$numprocesses = $stats[3];
?>
<h2>System Load</h2>
<p><span class="bigtext"><?php echo $onem; ?></span></p>
<p><span class="smalltext">5 min:&nbsp;<?php echo $fivem; ?> / 15 min:&nbsp;<?php echo $fifteenm; ?><br /><?php echo $numprocesses; ?> running processes</span></p>