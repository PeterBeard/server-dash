<?php
exec('uname -r', $kernel_info);
exec('uname -i', $kernel_platform);
exec('lsb_release -d',$os_info);

$os_name = '';
if(preg_match('/Description:\s+(.+)/',$os_info[0],$matches))
{
	$os_name = $matches[1];
}
?>
<h2>OS Info</h2>
<p>OS:&nbsp;<em><?php echo $os_name; ?></em></p>
<p>Kernel:&nbsp;<em><?php echo $kernel_info[0]; ?></em></p>
<p>Platform:&nbsp;<em><?php echo $kernel_platform[0]; ?></em></p>