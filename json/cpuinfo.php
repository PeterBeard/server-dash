<?php
$stats = file_get_contents('/proc/cpuinfo');
$stats = explode("\n",$stats);

foreach($stats as $line)
{
	if(preg_match('/model name\s+:\s+(.+)/',$line,$matches))
	{
		$cpuname = $matches[1];
	}
	if(preg_match('/cpu MHz\s+:\s+(.+)/',$line,$matches))
	{
		$cpuspeed = $matches[1];
	}
	if(preg_match('/cpu cores\s+:\s+(.+)/',$line,$matches))
	{
		$ncores = $matches[1];
	}
}
$corepl = ($ncores == 1) ? '' : 's';
?>
<h2>CPU Info</h2>
<p>CPU:&nbsp;<em><?php echo $cpuname; ?></em></p>
<p>Speed:&nbsp;<em><?php echo $ncores; ?> core<?php echo $corepl; ?> @ <?php printf('%4.0f',$cpuspeed); ?> MHz</em></p>
