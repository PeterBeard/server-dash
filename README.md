Installation
============

1. Check out the files using git
2. Put the files somewhere on the server you wish to monitor (I like /var/www/dash)
3. Make sure the PHP files are executable
4. That's it

Writing Modules
===============

JS modules live in the modules subdirectory. Each module consists of a folder named after the module it contains and a .js file also with the same name as the module. Any files this script depends on should also be placed in the module folder.

For example, the uptime module depends on a PHP script that reads /proc/uptime, so its directory looks like this

    modules
       - uptime
          - uptime.js
          - uptime.php
          
The .js file should add an event listener that contains all of its display code. There are two events that can be triggered: `singleupdate` and `liveupdate`. `singleupdate` is triggered once after the page loads and then never again. `liveupdate` is called at a fixed interval after the page is loaded.

For example, this is the relevant code for the uptime module:

    $(document).on("liveupdate", function(e) {
        . . .
    });
    
The event handler code should get whatever data it needs to display and write HTML to an element with its ID. For example, the uptime module writes to a div called `#uptime`. Nothing prevents a module from writing to the entire page, so it is up to the user to avoid installing malicious JavaScript modules.

Supported Platforms
===================

This code has been tested on Ubuntu 12.04 with Apache 2.2.22 and PHP 5.3.10. It *should* work just fine on any Debian-based distro and, with a little tweaking, any POSIX-compatible OS.

There is currently no (and there is not likely to be) support for Windows / IIS systems.
