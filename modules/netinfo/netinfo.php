<?php
# Try pinging a few different servers
$addrs = array('8.8.8.8','4.2.2.2','208.67.222.222','192.168.1.1');
$pings = array();
foreach($addrs as $a)
{
    $output = `ping $a -c 5 -i 0.3 -q`;
    # "0 received" is easy to search for
    if(strstr($output, '0 received'))
    {
        $matches = array('--','--','--','--','--');
    } else {
        preg_match('/.+ = ([\d.]+)\/([\d.]+)\/([\d.]+)\/([\d.]+).+/', $output, $matches);
    }
    $pings[$a] = array($matches[1], $matches[2], $matches[3], $matches[4]);
}
?>
{
    "times": [
        <?php foreach($pings as $ip=>$t): ?>
        {
            "ip": "<?php echo $ip; ?>",
            "min": "<?php echo $t[0]; ?>",
            "avg": "<?php echo $t[1]; ?>",
            "max": "<?php echo $t[2]; ?>",
            "mdev": "<?php echo $t[3]; ?>"
        }<?php if($ip != $addrs[count($addrs)-1]){echo ',';}?>
        <?php endforeach; ?>
    ]
}
