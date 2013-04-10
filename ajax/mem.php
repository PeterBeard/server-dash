<?php
$stats = file_get_contents('/proc/meminfo');
$stats = explode("\n",$stats);
$used = 0;
$total = 0;
foreach($stats as $line)
{
	if(preg_match('/MemTotal:\s+(\d+)/',$line,$matches))
	{
		$total = $matches[1];
	}
	if(preg_match('/MemFree:\s+(\d+)/',$line,$matches))
	{
		$used = $total - $matches[1];
	}
}

$prefixes = array('k','M','G','T');
$pindex = 0;
while($total >= 1024)
{
	$total/=1024;
	$used/=1024;
	$pindex++;
}
?>
<h2>Memory</h2>
<p><span class="bigtext"><?php printf('%3.1f',$used); ?>&nbsp;<?php echo $prefixes[$pindex]; ?>B</span>&nbsp;used</p>
<p><span class="medtext">/&nbsp;<?php printf('%3.1f',$total); ?>&nbsp;<?php echo $prefixes[$pindex]; ?>B</span>&nbsp;total</p>
