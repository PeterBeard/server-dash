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
?>
{
	"cpuname":"<?php echo $cpuname; ?>",
    "cores":"<?php echo $ncores; ?>",
    "speedmhz":"<?php printf('%4.0f',$cpuspeed); ?>"
}
