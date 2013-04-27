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
{
	"diskcount":"<?php echo count($disks); ?>",
    "disks":
    [
    	<?php foreach($disks as $disk): ?>
        {
        	"device":"<?php echo $disk['device']; ?>",
            "mountpoint":"<?php echo $disk['mountpoint']; ?>",
            "used":"<?php echo $disk['used']; ?>",
            "available":"<?php echo $disk['available']; ?>",
            "total":"<?php echo $disk['total']; ?>"
        }<?php echo $disk != $disks[count($disks)-1] ? "," : ""; ?>
        <?php endforeach; ?>
    ]
}
