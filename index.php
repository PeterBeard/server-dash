<?php
//require_once('Config.php');

$ip = $_SERVER['REMOTE_ADDR'];
$server_ip = $_SERVER['SERVER_ADDR'];

// Figure out our network address
$local_slash_24 = '';
preg_match('/(\d+\.\d+\.\d+)\.\d+/', $server_ip, $matches);
$local_slash_24 = $matches[1];

$services = array(
	array('name'=>'Sick Beard', 'port'=>'8080', 'url'=>'http://'.$server_ip.':8080/home/', 'status'=>'ok'),
	array('name'=>'CouchPotato', 'port'=>'5050', 'url'=>'http://'.$server_ip.':5050/', 'status'=>'ok'),
	array('name'=>'SABNzbd+', 'port'=>'9090', 'url'=>'http://'.$server_ip.':9090/', 'status'=>'ok'),
	array('name'=>'Transmission', 'port'=>'9091', 'url'=>'http://'.$server_ip.':9091/transmission/web', 'status'=>'ok'),
	array('name'=>'Seafile', 'port'=>'8000', 'url'=>'http://'.$server_ip.':8000/', 'status'=>'ok'),
);

// Check the HTTP headers returned by each service to see if they're available
$index = 0;
foreach($services as $s)
{
    $headers = @get_headers($s['url']);
    // If a 500-series or a 404 code is returned, the service is inaccessible
    if(!$headers || stristr($headers[0],'404') || preg_match('/5\d\d/',$headers[0]))
    {
        $code = $headers[0];
        $services[$index]['status'] = 'error';
        $services[$index]['detail'] = $headers[0];
    }
    $index++;
}
// Icons corresponding to statuses
$statusimgs = array(
	'ok' => 'images/icons/accept.png',
    'error' => 'images/icons/error.png'
);

// Check if a reboot is required
if(file_exists('/var/run/reboot-required'))
{
    $reboot_text = file_get_contents('/var/run/reboot-required');
    $reboot_packages = file_get_contents('/var/run/reboot-required.pkgs');
    $reboot_required = '';
    if(!empty($reboot_text))
    {
        $reboot_required = "<p class=\"error\">$reboot_text</p>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Server Dashboard</title>
        <link type="text/css" rel="stylesheet" href="css/global.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="modules/load-modules.js"></script>
        <script type="text/javascript">
		function updateStats()
		{
			// Trigger live-updating modules
			$.event.trigger({
				type: "liveupdate"
			});
		}
		$(document).ready(function() {
			updateStats();
			setInterval(updateStats, 1000);
			$.event.trigger({
				type: "singleupdate"
			});
		});
		</script>
    </head>
    <body>
        <div id="container">
            <h1>Server Dashboard</h1>
            <?php echo $reboot_required; ?>
            <div class="statusbox" id="uptime"></div>
            <div class="statusbox" id="loadavg"></div>
            <div class="statusbox" id="meminfo"></div>
            <br style="clear:both;" />
            
            <h1>Disks</h1>
            <div id="df">
            </div>

            <h1>Network</h1>
            <div id="netinfo"></div>
            <h1>LAN Services</h1>
            <?php if(stristr($ip,$local_slash_24)): ?>
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
                	<td><a href="http://<?php echo $server_ip; ?>/phpmyadmin/"><img src="images/icons/cog_edit.png" alt="Web interface" title="View web interface" /></a></td>
                    <td>PHPMyAdmin</td>
                    <td>80</td>
                    <td><img src="<?php echo $statusimgs['ok']; ?>" alt="ok" title="ok" /></td>
                </tr>
            </table>
            <?php else: ?>
            <p class="error">LAN services are not accessible from outside the local network.</p>
            <?php endif; ?>
            <h1>System Info</h1>
            <div class="statusbox" id="osinfo"></div>
            <div class="statusbox" id="cpuinfo"></div>
            <div class="statusbox" id="dpkg"></div>
            <br style="clear:both;" />
        </div>
    </body>
</html>
