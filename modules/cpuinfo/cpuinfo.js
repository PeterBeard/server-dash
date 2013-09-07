// server-dash cpuinfo module
// Peter Beard - 2013-04-27

// Attach handler to loadonce event to update this code only when the page loads
$(document).on("singleupdate", function(e) {
	// CPU information
	$.getJSON("modules/cpuinfo/cpuinfo.php", function(data) {
		// Determine whether 'core' should be plural
		var corepl = data.cores != 1 ? "s" : "";
		$("#cpuinfo").html("<h2>CPU Info</h2>");
		$("#cpuinfo").append("<p>CPU: <em>" + data.cpuname + "</em></p>");
		$("#cpuinfo").append("<p>Speed: <em>" + data.cores + " core" + corepl + " @ " + data.speedmhz + "&nbsp; MHz</em></p>");
	});
});