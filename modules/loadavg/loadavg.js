// server-dash cpuinfo module
// Peter Beard - 2013-04-27

// Attach handler to displayupdate event to update on every tick
$(document).on("liveupdate", function(e) {
	// System load
	$.getJSON("modules/loadavg/loadavg.php", function(data) {
		$('#loadavg').html('<h2>System Load</h2>');
		$('#loadavg').append('<p><span class="bigtext">' + data.oneminuteload + '</span></p>');
		$('#loadavg').append('<p><span class="smalltext">5 min:&nbsp;' + data.fiveminuteload + ' / 15 min:&nbsp;' + data.fifteenminuteload + '<br />' + data.numberofprocesses + ' running processes</span></p>');
	});
});