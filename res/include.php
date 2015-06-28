<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//session_destroy();
session_start();

require_once 'vendor/autoload.php';
require_once 'generated-conf/config.php';

// In case the site has an auth response
Auth::processAuth();

spl_autoload_register (function ($class) {
    $class_paths = ["lib/", "lib/model/", "vendor/propel/propel/src/"];

    $class= str_replace("\\","/",$class);


    foreach ($class_paths as $path) {
        //echo $path . $class . '.php<br/>';
        if (file_exists($path . $class . '.php')) {
            //echo "found<br/>";
            require_once $path . $class . '.php';
        }
    }
});

// Libaries necessary for every page go in here



?>