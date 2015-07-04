# PCMasterRatings

##Composer & Plugin Setup
*In order to run the site, you will need to install composer and a couple of plugins for it*

**Note**: Composer requires a minumum php version of **5.4**. If you are running a lower version than this, you will run into issues.


####Mac/Linux Installation

note to linux users: you may first need to install php. Please follow [this guide](http://php.net/manual/en/install.unix.debian.php).

1. 	Open terminal, then navigate to the pcmratings project directory e.g. `cd home/me/docs/pcmratings`
2.	Type `php composer.phar install`
3.	Wait while the necessary files are downloaded. You can verify this by looking for a /vendor/ folder in the site's root directory.
4. 	If you have issues with installation, try moving the composer.phar file out of the /bin/ directory.


####Windows Installation

1.	Download php binaries from http://windows.php.net/download/ If you already have php installed, skip to step *4*.
2. 	Unzip some where like C:\PHP5\
3. 	Add to PATH: *(Optional - skip to step 4)*
  1.	Go to Control Panel and open the System icon (Control Panel → System and Security → System).
  2.  Click Advanced System Settings.
  3.  Click on the 'Environment Variables' button.
  4.	Look into the 'System Variables' pane.
  5.	Find the Path entry (you may need to scroll to find it).
  6.  Double click on the Path entry.
  7.	Enter your PHP directory at the end, including ';' before (e.g. ;C:\php).
  8.	Your PATH should look something like this: `C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\PHP5`
  9.	Press OK.
  10.	You should now be able to access php through cmd prompt by simply typing "php [command]".
14.	Navigate to the pcmratings project directory using cd e.g. `cd C:\Users\me\Documents\pcmratings\site`
15.	From here, type `php composer.phar install` If you skipped step 3, you will need to type `C:\PHP5\php.exe` instead of `php`
16. Composer should now download the necessary files. Once it's done, you can verify this by looking for a /vendor/ folder in the site's root directory.
17.	If you have issues with installation, try moving the composer.phar file out of the /bin/ directory.

####Remote Installation

If you are running a remote test environment, i.e. hosting it on your own site, you will need to install composer remotely. This guide assumes you're running on a linux environment.

For this, you will need ssh access. Check with your provider about getting this set up.

1. Once you have ssh access, ssh into your remote server and navigate to the pcmratings directory.
2. from here, type `php composer.phar install`. It should install composer and several plugins.
3. If the installation has completed correctly, you should now see a /vendor/ folder in the main directory.

####General Commands

To regenerate autoload files: `php composer.phar dump-autoload`. You will need to do this if you change the composer.json file, or if you add/delete any files to the folders it points to.

To rebuild model objects based on schema: `php vendor/propel/propel/bin/propel.php build`. You will need to do this if you change the database or schema.xml in any way.

##Giantbomb Api Key

In order to successfully retrieve data from Giantbomb, you'll need an api key. Either create your own account on http://www.giantbomb.com/api or ask someone in slack for a key (if you are a member - we are sharing one at the moment).

Once you have your api key, place it in /generated-conf/config.php in the `GBApi::setApiKey();` function call as a string argument.
