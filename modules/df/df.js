// server-dash df module
// Peter Beard - 2013-04-27

// Attach handler to loadonce event to update this code only when the page loads
$(document).on("loadonce", function(e) {
	// Load information about mounted disks
	$.getJSON("modules/df/df.php", function(data) {
		// Generate table headings
		var table = $("<table></table>");
		table.append("<tr><th>Device</th><th>Mount Point</th><th>Space Used</th><th>Space Available</th><th>Total Size</th></tr>");
		for(var i=0; i<data.diskcount; i++)
		{
			var row = $("<tr></tr>");
			row.append("<td>" + data.disks[i].device + "</td>");
			row.append("<td>" + data.disks[i].mountpoint + "</td>");
			row.append("<td>" + data.disks[i].used + "</td>");
			row.append("<td>" + data.disks[i].available + "</td>");
			row.append("<td>" + data.disks[i].total + "</td>");
			table.append(row);
		}
		$("#df").append(table);
	});
});