# PCMasterRatings

*Before running the site, you will need to install composer and our various other plugins for it*


####Mac/Linux Instructions

note to linux users: you may first need to install php. Please follow [this guide](http://php.net/manual/en/install.unix.debian.php)

1. 	Open terminal, then navigate to the pcmratings project directory e.g. `cd home/me/docs/pcmratings`
2.	Type `php bin/composer.phar install`
3.	Wait while the necessary files are downloaded. You can verify this by looking for a /vendor/ folder in the site's root directory.
4. 	If you have issues with installation, try moving the composer.phar file out of the /bin/ directory.


####Windows Instructions

1.	Download php binaries from `http://windows.php.net/download/` If you already have php installed, skip to step *4*.
 		php 5.4 MINIMUM
2. 	Unzip some where like C:\PHP5\
3. 	Add to PATH: **(Optional - skip to step )**
4.	Go to Control Panel and open the System icon (Control Panel → System and Security → System).
5.  Click Advanced System Settings.
6.  Click on the 'Environment Variables' button.
7.	Look into the 'System Variables' pane.
8.	Find the Path entry (you may need to scroll to find it).
9.  Double click on the Path entry.
10.	Enter your PHP directory at the end, including ';' before (e.g. ;C:\php).
11.	Your PATH should look something like this: `C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\PHP5`
12.	Press OK.
13.	You should now be able to access php through cmd prompt by simply typing "php [command]".
14.	Navigate to the pcmratings project directory using cd e.g. `cd C:\Users\me\Documents\pcmratings\site`
15.	From here, type `php bin/composer.phar install` If you skipped step 3, you will need to type `C:\PHP5\php.exe` instead of `php`
16. Composer should now download the necessary files. Once it's done, you can verify this by looking for a /vendor/ folder in the site's root directory.
17.	If you have issues with installation, try moving the composer.phar file out of the /bin/ directory.


To regenerate autoload files: `php bin/composer.phar dump-autoload`

To rebuild model objects ased on schema: `php vendor/propel/propel/bin/propel.php build`