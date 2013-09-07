// server-dash os info module
// Peter Beard - 2013-04-27

// Attach handler to loadonce event to update this code only when the page loads
$(document).on("singleupdate", function(e) {
	// Operating system information
	$.getJSON("modules/osinfo/osinfo.php", function(data) {
		$("#osinfo").html("<h2>OS Info</h2>");
		$("#osinfo").append("<p>OS: <em>" + data.os + "</em></p>");
		$("#osinfo").append("<p>Kernel: <em>" + data.kernel + "</em></p>");
		$("#osinfo").append("<p>Platform: <em>" + data.platform + "</em></p>");
	});
});