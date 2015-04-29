var enabledModules = ["loadavg","meminfo","uptime","cpuinfo","df","osinfo","dpkg","netinfo"];

// Load enabled modules
$.each(enabledModules, function(index, module) {
	$("head").append('<script type="text/javascript" src="modules/' + module + '/' + module + '.js"></script>');
});
