// server-dash netinfo module
// Peter Beard - 2015-04-28

// Attach handler to displayupdate event to update on every tick
$(document).on("singleupdate", function(e) {
    // Add some placeholder text
    $('#netinfo').html('<p class="info">Pinging servers...</p>');
	// Get the network info
	$.getJSON("modules/netinfo/netinfo.php", function(data) {
        html = '<table><tr><th>IP</th><th>Min (ms)</th><th>Avg (ms)</th><th>Max (ms)</th><th>Mdev (ms)</th></tr>';
        $.each(data.times, function(i, value) {
            html += '<tr><td>' + value.ip + '</td><td>' + value.min + '</td><td>' + value.avg + '</td><td>' + value.max + '</td><td>' + value.mdev + '</td></tr>';
        });
        html += '</table>';
        $('#netinfo').html(html);
	});
});
