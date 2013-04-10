<!DOCTYPE html>
<?php
$ip = $_SERVER['REMOTE_ADDR'];

$services = array(
	array('name'=>'Sick Beard', 'port'=>'8080', 'url'=>'http://10.0.0.100:8080/home/', 'status'=>'ok'),
	array('name'=>'CouchPotato', 'port'=>'5050', 'url'=>'http://10.0.0.100:5050/', 'status'=>'ok'),
	array('name'=>'SABNzbd+', 'port'=>'9090', 'url'=>'http://10.0.0.100:9090/', 'status'=>'ok'),
	array('name'=>'Transmission', 'port'=>'9091', 'url'=>'http://10.0.0.100:9091/transmisson/web', 'status'=>'ok'),
);

$statusimgs = array(
	'ok' => 'images/icons/accept.png'
);
?>
<html>
    <head>
        <title>Server Dashboard</title>
        <link type="text/css" rel="stylesheet" href="css/global.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
		var initialized = false;
		function updateStats()
		{
			$("#uptime").load("ajax/uptime.php");
			$("#mem").load("ajax/mem.php");
			$("#cpu").load("ajax/cpu.php");
			if(!initialized)
			{
				$("#disks").load("ajax/hd.php");
				$("#distro").load("ajax/os.php");
				$("#cpuinfo").load("ajax/cpuinfo.php");
				$("#packages").load("ajax/package-versions.php");
			}
			initialized = true;
		}
		$(document).ready(function() {
			updateStats();
			setInterval(updateStats, 1000);
		});
		</script>
    </head>
    <body>
        <div id="container">
            <h1>Server Dashboard</h1>
            <div class="statusbox" id="uptime"></div>
            <div class="statusbox" id="cpu"></div>
            <div class="statusbox" id="mem"></div>
            <br style="clear:both;" />
            
            <h1>Disks</h1>
            <div id="disks">
            </div>
            <h1>LAN Services</h1>
            <?php if(stristr($ip,'10.0.0.')): ?>
            <table>
            	<tr>
                	<th></th>
                    <th>Name</th>
                    <th>Port</th>
                    <th>Status</th>
                </tr>
                <?php foreach($services as $service): ?>
                <tr>
                	<td><a href="<?php echo $service['url']; ?>"><img src="images/icons/cog_edit.png" alt="Web interface" title="View web interface" /></a></td>
                    <td><?php echo $service['name']; ?></td>
                    <td><?php echo $service['port']; ?></td>
                    <td><img src="<?php echo $statusimgs[$service['status']]; ?>" alt="<?php echo $service['status']; ?>" title="<?php echo $service['status']; ?>" /></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                	<td><a href="http://10.0.0.100/phpmyadmin/"><img src="images/icons/cog_edit.png" alt="Web interface" title="View web interface" /></a></td>
                    <td>PHPMyAdmin</td>
                    <td>80</td>
                    <td><img src="<?php echo $statusimgs['ok']; ?>" alt="ok" title="ok" /></td>
                </tr>
            </table>
            <?php else: ?>
            <p class="error">LAN services are not accessible from outside the local network.</p>
            <?php endif; ?>
            <h1>System Info</h1>
            <div class="statusbox" id="distro"></div>
            <div class="statusbox" id="cpuinfo"></div>
            <div class="statusbox" id="packages"></div>
            <br style="clear:both;" />
        </div>
    </body>
</html>
