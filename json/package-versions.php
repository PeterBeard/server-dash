<?php
exec('transmission-cli --version', $tx_info);
exec('mysql --version', $mysql_info);

$mysql_version = '0';
$tx_version = '0';
if(preg_match('/Ver\s([\d\.]+)\sDistrib\s([\d\.]+)/',$mysql_info[0],$matches))
{
	$mysql_version = $matches[1] . ' / ' . $matches[2];
}
if(preg_match('/transmission-cli (.+)/',$tx_info[0],$matches))
{
	$tx_version = $matches[1];
}
?>
<h2>Package Versions</h2>
<p>PHP:&nbsp;<em><?php echo phpversion(); ?></em></p>
<p>mySQL:&nbsp;<em><?php echo $mysql_version; ?></em></p>
<p>Transmission:&nbsp;<em><?php echo $tx_version; ?></em></p>