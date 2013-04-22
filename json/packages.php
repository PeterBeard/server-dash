<?php
exec('dpkg --list | wc -l', $installed);
$installed = number_format($installed[0],0);
$package_updates = file_get_contents('/var/lib/update-notifier/updates-available');
preg_match('/(\d+) packages.+/',$package_updates,$matches);
$updates = $matches[1];
preg_match('/(\d+) updates.+/',$package_updates,$matches);
$security = $matches[1];
?>
{
	"installed":"<?php echo $installed; ?>",
	"updates":"<?php echo $updates; ?>",
    "securityupdates":"<?php echo $security; ?>"
}
