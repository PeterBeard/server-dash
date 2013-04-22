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
			// Uptime
			$.getJSON("json/uptime.php", function(data) {
				var day_pl = (data.days == 1) ? '' : 's';
				var hr_pl = (data.hours == 1) ? '' : 's';
				var min_pl = (data.minutes == 1) ? '' : 's';
				var sec_pl = (data.seconds == 1) ? '' : 's';
				
				$('#uptime').html('<h2>Uptime</h2>');
				var p = $('#uptime').append('<p></p>');
				p.append('<span class="bigtext">' + data.days + '</span>&nbsp;<span class="medtext">day' + day_pl + '</span>');
				p = $('#uptime').append('<p></p>');
				p.append('<span class="smalltext">' + data.hours + ' hour' + hr_pl + ', ' + data.minutes + ' minute' + min_pl + ', ' + data.seconds + ' second' + sec_pl + '</span>');
			});
			// Memory
			$.getJSON("json/mem.php", function(data) {
				$('#mem').html('<h2>Memory</h2>');
				var p = $('#mem').append('<p></p>');
				p.append('<span class="bigtext">' + data.usedmemory + '&nbsp;' + data.units + '</span>&nbsp;used');
				p = $('#mem').append('<p></p>');
				p.append('<span class="medtext">/&nbsp;' + data.totalmemory + '&nbsp;' + data.units + '</span>&nbsp;total');
			});
			// System load
			$.getJSON("json/cpu.php", function(data) {
				$('#cpu').html('<h2>System Load</h2>');
				var p = $('#cpu').append('<p></p>');
				p.append('<span class="bigtext">' + data.oneminuteload + '</span>');
				p = $('#cpu').append('<p></p>');
				p.append('<span class="smalltext">5 min:&nbsp;' + data.fiveminuteload + ' / 15 min:&nbsp;' + data.fifteenminuteload + '<br />' + data.numberofprocesses + ' running processes</span>');
			});
			// These only need to happen once when the page loads
			if(!initialized)
			{
				$("#disks").load("json/hd.php");
				$("#distro").load("json/os.php");
				$("#cpuinfo").load("json/cpuinfo.php");
				// Installed packages and available updates
				$.getJSON("json/packages.php", function(data) {
					$('#packages').html('<h2>Packages</h2>');
					var p = $('#packages').append('<p></p>');
					p.append('<span class="bigtext">' + data.installed + '</span>&nbsp;<span class="medtext">packages</span><br /><span class="smalltext">' + data.updates + ' updates, ' + data.securityupdates + ' security updates.</span>');
					p = $('#mem').append('<p></p>');
					p.append('<span class="medtext">/&nbsp;' + data.totalmemory + '&nbsp;' + data.units + '</span>&nbsp;total');
				});
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
