<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=localhost;dbname=pcmratings',
  'user' => 'pcmratings',
  'password' => '',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
));
$manager->setName('default');
$serviceContainer->setConnectionManager('default', $manager);
$serviceContainer->setDefaultDatasource('default');

//GB apikey - if you need one, ask or get your own from GB.
GBApi::setApiKey('');

//RedditAuth
RedditAuth::setClientId(''); //public client id, accessible from your reddit API developer page
RedditAuth::setClientSecret(''); //private "secret", accessible from your reddit API developer page
RedditAuth::setRedirectUrl(''); //set this to http://[your host]/index.php e.g. http://pcmr.darkholme.net/index.php