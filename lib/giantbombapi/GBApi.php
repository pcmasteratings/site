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
        self::validateApiKey();

        //Change these if we need to include more stuff.
        $fieldArr = [
            'id',
            'name',
            'original_release_date',
            'image',
            'api_detail_url',
            'deck',
            'image',
            'platforms'
        ];

        //sanitise query
        $query = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($query))))));
        //generate url
        $url = self::$gb
            .'games?api_key='.self::$apikey
            .'&format=json'
            .self::formatFieldList($fieldArr)
            .'&limit='.$limit //Limit results - max 100
            .'&filter=platforms:17|94|152,name:'.$query; //Limit to Mac, PC, Linux respectively.
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

        $games = []; //initialise as empty array
        foreach ($json->results as $result)
        {
            if (!isset($result->original_release_date) || $result->original_release_date == null)
                continue; //skip if not out yet.
            $game = GamesQuery::create()->findOneByGbId($result->id);
            if (!isset($game))
            {
                $game = new Games();
                $game->setGbId($result->id);
            }

            $game->setName(Games::generateUniqueName($result->name, $result->original_release_date));
            $game->setGbUrl($result->api_detail_url);
            $game->setTitle($result->name);
            $game->setDescription($result->deck);
            //We don't care if they don't have thumbs. Catch the exceptions and move on
            try
            {
                $game->setGbThumb($result->image->screen_url);
            }
            catch (Exception $e) { }
            try
            {
                $game->setGbImage($result->image->medium_url);
            }
            catch (Exception $e) { }


            $game->save();

            $gbplatforms = [];
            foreach($result->platforms as $gbplatform)
            {
                array_push($gbplatforms, $gbplatform->id);
            }

            //Remove invalid platforms
            $currentPlatforms = $game->getValidPlatforms();
            foreach ($currentPlatforms as $plat)
            {
                if (!in_array($plat->getGbId(), $gbplatforms))
                {
                    $gamePlatform = GamePlatformsQuery::create()
                        ->filterByGames($game)
                        ->filterByPlatforms($plat)
                        ->findOne();
                    $game->removeGamePlatforms($gamePlatform);

                }
            }

            //add new platforms
            $allPlatforms = PlatformsQuery::create()->find();
            foreach ($allPlatforms as $plat)
            {
                if (in_array($plat->getGbId(), $gbplatforms))
                {
                    $gamesPlatform = new GamePlatforms();
                    $gamesPlatform->setGames($game);
                    $gamesPlatform->setPlatforms($plat);
                    $gamesPlatform->save();
                }
            }

            //$gamesPlatform = new GamePlatforms();
            //$gamesPlatform->setGames($game);
            //$gamesPlatform->setPlatforms($allPlatforms[1]);
            //$gamesPlatform->save();
            //append result to list.
            $game->save();
            array_push($games, $game);
        }

        return $games;
    }

    private static function formatFieldList($fieldArr)
    {
        if (!isset($fieldArr) || $fieldArr == null)
            throw new Exception('Field Array not Set.');
        $glue = ','; //Delimiter for field list values.
        //Implode the array so we can add it to the gb request in string format
        $fieldStr = '&field_list='.implode($glue, $fieldArr);
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
            throw new GBApiException('Undefined Giantbomb api key; please set this in res/config.php');
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
