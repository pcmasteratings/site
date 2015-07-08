<?php

/*
* Giantbomb Api calls are done here
* Made with love by nirkbirk
*/
abstract class GBApi
{
  private static $apikey;
  private static $gb = 'http://www.giantbomb.com/api/';

  //Can only be set once. Configure this in config.php.
  public static function setApiKey($key)
  {
    if (!isset(GBApi::$apikey))
    {
      GBApi::$apikey = $key;
    }
  }

  //Limits search to one game
  public static function searchForGame($query)
  {

    return searchForGames($query, 1)[0]; //Will only return one game, so grab the first element in the array.
  }
  public static function searchForGames($query, $limit = 10)
  {
    $json = self::search($query,
    GBSearchType::Game,
    [
      'id',
      'name',
      'original_release_date',
      'image',
      'api_detail_url',
      'deck',
      'image'
    ],
    $limit);

    $games = []; //initialise as empty array
    foreach ($json->results as $result)
    {
      $game = GamesQuery::create()->findOneByGbId($result->id);
      if ($game == null)
      {
        $game = new Games();
        $game->setGbId($result->id);
        $game->setName(Games::generateUniqueName($result->name, $result->original_release_date));
        $game->setGbUrl($result->api_detail_url);
        $game->setTitle($result->name);
        $game->setDescription($result->deck);
        $game->setGbThumb($result->image->screen_url);
        $game->setGbImage($result->image->medium_url);
        $game->save();
      }
      //append result to list.
      array_push($games, $game);
    }

    return $games;
  }

  //returns an array of results OR throws GBApiException - MAKE SURE TO CATCH THIS!!
  //Do not use this for front-end searches. Use one of the specific methods instead e.g. searchForGames() -- We should ONLY return propel objects.
  private static function search($query, $srchtype, $fieldArr = null, $limit = 10)
  {
    self::validateApiKey();
    //http://www.giantbomb.com/api/search?api_key=[YOUR-KEY]&format=[RESPONSE-DATA-FORMAT]&query=[YOUR-SEARCH]&resources=[SOME-TYPES]
    if (!GBSearchType::check($srchtype))
    {
      throw new GBApiException('Invalid Search Type: '.$srchtype);
    }

    $fieldStr = '';
    if ($fieldArr != null)
    {
      $glue = ','; //Delimiter for field list values.
      //Implode the array so we can add it to the gb request in string format
      $fieldStr = '&field_list='.implode($glue, $fieldArr);
    }

    //sanitise query
    $query = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($query))))));
    //generate url
    $url = self::$gb
    .'search?api_key='.self::$apikey
    .'&format=json&query='.$query
    .'&resources='.$srchtype
    .$fieldStr
    .'&limit='.$limit; //Limit results - max 100

    try
    {
      $json = self::makeApiCall($url);
    }
    catch(Exception $e)
    {
      throw new GBApiException('Error contacting Giantbomb. Please try again later.');
    }
    //QueryDb and try to find the object using the giantbomb unique id
    if ($json->results == null || count($json->results) < 1)
    {
      throw new GBApiException('No results found. Please try another search.');
    }

    return $json;
  }

  public static function getByGbUrl($gburl, $fieldArr = null)
  {
    self::validateApiKey();

    //TODO Format gburl into proper GiantBomb api call and set it off using makeApiCall()
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

    //We have our response from GB, let's decode it into a php JSON object.
    $json = json_decode($response);

    //dbg
    //echo $response;

    //Check status code. If it's unsuccessful, throw an exception.
    if ($json->status_code != GBStatusCode::Ok)
    {
      throw new GBApiException("Api call failed with error code: {$json->status_code} - {$json->error}");
    }

    //If we've got this far, we've got valid json - we can return the object.
    return $json;
  }

  //This method should be called whenever an api call is made.
  //Here we can do the APIKey checks and any other necessary procedures.
  private static function validateApiKey()
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
    return "{$this->message}\n";
  }
}

//enums for GB Status Codes. Valid codes at http://www.giantbomb.com/api/documentation
abstract class GBStatusCode
{
  const Ok = 1;
  const InvalidApiKey = 100;
  const ObjectNotFound = 101;
  const UrlFormatError = 102;
  const JsonpFormatError = 103;
  const FilterError = 104;
  const SubOnlyVideo = 105;
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
      //We aren't handling any of the following yet. Uncomment once we have proper propel objects for these.
      //case self::Franchise:
      //case self::Character:
      //case self::Concept:
      //case self::Obj:
      //case self::Location:
      //case self::Person:
      //case self::Company:
      //case self::Video:
      return true;
      default:
      return false;
    }
  }
}
