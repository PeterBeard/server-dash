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
{
	"os":"<?php echo $os_name; ?>",
    "kernel":"<?php echo $kernel_info[0]; ?>",
    "platform":"<?php echo $kernel_platform[0]; ?>"
}
