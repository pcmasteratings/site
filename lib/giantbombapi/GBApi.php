<?php

/*
* Giantbomb Api calls are done here
* Made with love by nirkbirk
*/
class GBApi
{
  private static $apikey;
  private static $gb = 'http://www.giantbomb.com/api/';

  public static function __callStatic($name, $arguments)
  {
    // Note: value of $name is case sensitive.
    echo "Calling static method '$name' "
    . implode(', ', $arguments). "\n";
  }
  //Can only be set once. Configure this in config.php.
  public static function setApiKey($key)
  {
    if (!isset(GBApi::$apikey))
    {
      GBApi::$apikey = $key;
    }
  }

  public static function search($query, $srchtype)
  {
    self::validApiKey();
    //http://www.giantbomb.com/api/search?api_key=[YOUR-KEY]&format=[RESPONSE-DATA-FORMAT]&query=[YOUR-SEARCH]&resources=[SOME-TYPES]
    if (!GBSearchType::check($srchtype))
    {
      throw new GBApiException('Invalid Search Type: '.$srchtype);
    }
  //generate url
  $url = self::$gb.'search?api_key='.self::$apikey.'&format=json&query='.$query.'&resources='.$srchtype;

  self::makeApiCall($url);
  echo $url;
  return '';
}

//Here we package the call into a http request and fire it over to giantbomb
//GB Responds with json-encoded data.
private static function makeApiCall($url)
{
  $options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Content-Type: application/json; charset=utf-8"
  )
);

$context = stream_context_create($options);
  $response = file_get_contents($url, false, $context);

  //dbg - temporary...
  var_dump(json_decode($response));
}

//This method is called whenever an api call is made.
//Here we can do the APIKey checks and any other necessary procedures.
  private static function validApiKey()
  {
    if (!isset(self::$apikey) || strlen(self::$apikey) < 1)
    {
      throw new GBApiException('Undefined api key; please set this in /generated-conf/config.php', 0);
    }
  }
}

//Exceptions for GiantBombApi calls.
class GBApiException extends Exception
{
  public function __construct($message, $code = 0, Exception $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
  public function __toString()
  {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}

//enums for searchtypes.
abstract class GBSearchType
{
  const Game = 'game';
  const Franchise = 'franchise';
  const Character = 'character';
  const Concept = 'concept';
  const Obj = 'object';
  const Location = 'location';
  const Person = 'person';
  const Company = 'company';
  const Video = 'video';

  //Check the type is correct.
  public static function check($type)
  {
    switch ($type)
    {
      case self::Game:
      case self::Franchise:
      case self::Character:
      case self::Concept:
      case self::Obj:
      case self::Location:
      case self::Person:
      case self::Company:
      case self::Video:
      return true;
      default:
      return false;
    }
  }
}
