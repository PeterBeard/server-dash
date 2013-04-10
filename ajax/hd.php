<?php
$disks = array();
exec('df -h', $disk_info);

foreach($disk_info as $line)
{
	if(preg_match('/(\/[^\s]+)\s+([^\s]+)\s+([^\s]+)\s+([^\s]+).+(\/[^\s]*)/',$line,$matches))
	{
		$total = preg_replace('/([\d\.]+)(\w)/','$1&nbsp;$2',$matches[2]);
		$used = preg_replace('/([\d\.]+)(\w)/','$1&nbsp;$2',$matches[3]);
		$available = preg_replace('/([\d\.]+)(\w)/','$1&nbsp;$2',$matches[4]);
		
		$disks[] = array('device'=>$matches[1],'mountpoint'=>$matches[5],'used'=>$used.'B','available'=>$available.'B','total'=>$total.'B');
	}
}
?>
<table>
    <tr>
        <th>Device</th>
        <th>Mount Point</th>
        <th>Space Used</th>
        <th>Space Available</th>
        <th>Total Size</th>
    </tr>
    <?php foreach($disks as $disk): ?>
    <tr>
    	<td><?php echo $disk['device']; ?></td>
        <td><?php echo $disk['mountpoint']; ?></td>
        <td><?php echo $disk['used']; ?></td>
        <td><?php echo $disk['available']; ?></td>
        <td><?php echo $disk['total']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>