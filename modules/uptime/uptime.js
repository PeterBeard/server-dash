// server-dash meminfo module
// Peter Beard - 2013-04-27

// Attach handler to displayupdate event to update on every tick
$(document).on("liveupdate", function(e) {
	// Uptime
	$.getJSON("modules/uptime/uptime.php", function(data) {
		var day_pl = (data.days == 1) ? '' : 's';
		var hr_pl = (data.hours == 1) ? '' : 's';
		var min_pl = (data.minutes == 1) ? '' : 's';
		var sec_pl = (data.seconds == 1) ? '' : 's';
		
		$('#uptime').html('<h2>Uptime</h2>');
		$('#uptime').append('<p><span class="bigtext">' + data.days + '</span>&nbsp;<span class="medtext">day' + day_pl + '</span></p>');
		$("#uptime").append('<p><span class="smalltext">' + data.hours + ' hour' + hr_pl + ', ' + data.minutes + ' minute' + min_pl + ', ' + data.seconds + ' second' + sec_pl + '</span></p>');
	});
});