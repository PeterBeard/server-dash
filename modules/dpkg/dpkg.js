// server-dash dpkg module
// Peter Beard - 2013-04-27

// Attach handler to loadonce event to update this code only when the page loads
$(document).on("singleupdate", function(e) {
	// Installed packages and available updates
	$.getJSON("modules/dpkg/dpkg.php", function(data) {
		// Correct pluralization
		var secpl = data.securityupdates != 1 ? "s" : "";
		var updatepl = data.updates != 1 ? "s" : "";
		
		$('#dpkg').html('<h2>Packages</h2>');
		$('#dpkg').append('<p><span class="bigtext">' + data.installed + '</span>&nbsp;<span class="medtext">packages</span><br /><span class="smalltext">' + data.updates + ' update' + updatepl + ', ' + data.securityupdates + ' security update' + secpl + '.</span></p>');
	});
});