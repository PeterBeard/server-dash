// server-dash meminfo module
// Peter Beard - 2013-04-27

// Attach handler to displayupdate event to update on every tick
$(document).on("displayupdate", function(e) {
	// Memory
	$.getJSON("modules/meminfo/meminfo.php", function(data) {
		$('#meminfo').html('<h2>Memory</h2>');
		$('#meminfo').append('<p><span class="bigtext">' + data.usedmemory + '&nbsp;' + data.units + '</span>&nbsp;used</p>');
		$('#meminfo').append('<p><span class="medtext">/&nbsp;' + data.totalmemory + '&nbsp;' + data.units + '</span>&nbsp;total</p>');
	});
});