<?php

use Base\Game as BaseGame;

/**
 * Skeleton subclass for representing a row from the 'game' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Game extends BaseGame
{

    // Transliteration array obtained from http://stackoverflow.com/questions/6837148/change-foreign-characters-to-normal-equivalent
    private static $TRANSLITERATABLE_CHARACTERS =
        array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', '?' => 'a', '?' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a',
            'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', '?' => 'a', '?' => 'A', '?' => 'a', '?' => 'A', 'ä' => 'ae', 'Ä' => 'AE',
            'æ' => 'ae', 'Æ' => 'AE', '?' => 'b', '?' => 'B', '?' => 'c', '?' => 'C', '?' => 'c', '?' => 'C', '?' => 'c',
            '?' => 'C', '?' => 'c', '?' => 'C', 'ç' => 'c', 'Ç' => 'C', '?' => 'd', '?' => 'D', '?' => 'd', '?' => 'D',
            '?' => 'd', '?' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', '?' => 'e',
            '?' => 'E', 'ê' => 'e', 'Ê' => 'E', '?' => 'e', '?' => 'E', 'ë' => 'e', 'Ë' => 'E', '?' => 'e', '?' => 'E',
            '?' => 'e', '?' => 'E', '?' => 'e', '?' => 'E', '?' => 'f', '?' => 'F', 'ƒ' => 'f', '?' => 'F', '?' => 'g',
            '?' => 'G', '?' => 'g', '?' => 'G', '?' => 'g', '?' => 'G', '?' => 'g', '?' => 'G', '?' => 'h', '?' => 'H',
            '?' => 'h', '?' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i',
            'Ï' => 'I', '?' => 'i', '?' => 'I', '?' => 'i', '?' => 'I', '?' => 'i', '?' => 'I', '?' => 'j', '?' => 'J',
            '?' => 'k', '?' => 'K', '?' => 'l', '?' => 'L', '?' => 'l', '?' => 'L', '?' => 'l', '?' => 'L', '?' => 'l',
            '?' => 'L', '?' => 'm', '?' => 'M', '?' => 'n', '?' => 'N', '?' => 'n', '?' => 'N', 'ñ' => 'n', 'Ñ' => 'N',
            '?' => 'n', '?' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', '?' => 'o',
            '?' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', '?' => 'o', '?' => 'O', '?' => 'o', '?' => 'O',
            'ö' => 'oe', 'Ö' => 'OE', '?' => 'p', '?' => 'P', '?' => 'r', '?' => 'R', '?' => 'r', '?' => 'R', '?' => 'r',
            '?' => 'R', '?' => 's', '?' => 'S', '?' => 's', '?' => 'S', 'š' => 's', 'Š' => 'S', '?' => 's', '?' => 'S',
            '?' => 's', '?' => 'S', '?' => 's', '?' => 'S', 'ß' => 'SS', '?' => 't', '?' => 'T', '?' => 't', '?' => 'T',
            '?' => 't', '?' => 'T', '?' => 't', '?' => 'T', '?' => 't', '?' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u',
            'Ù' => 'U', '?' => 'u', '?' => 'U', 'û' => 'u', 'Û' => 'U', '?' => 'u', '?' => 'U', '?' => 'u', '?' => 'U',
            '?' => 'u', '?' => 'U', '?' => 'u', '?' => 'U', '?' => 'u', '?' => 'U', '?' => 'u', '?' => 'U', 'ü' => 'ue',
            'Ü' => 'UE', '?' => 'w', '?' => 'W', '?' => 'w', '?' => 'W', '?' => 'w', '?' => 'W', '?' => 'w', '?' => 'W',
            'ý' => 'y', 'Ý' => 'Y', '?' => 'y', '?' => 'Y', '?' => 'y', '?' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', '?' => 'z',
            '?' => 'Z', 'ž' => 'z', 'Ž' => 'Z', '?' => 'z', '?' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', '?' => 'a',
            '?' => 'a', '?' => 'b', '?' => 'b', '?' => 'v', '?' => 'v', '?' => 'g', '?' => 'g', '?' => 'd', '?' => 'd',
            '?' => 'e', '?' => 'E', '?' => 'e', '?' => 'E', '?' => 'zh', '?' => 'zh', '?' => 'z', '?' => 'z', '?' => 'i',
            '?' => 'i', '?' => 'j', '?' => 'j', '?' => 'k', '?' => 'k', '?' => 'l', '?' => 'l', '?' => 'm', '?' => 'm',
            '?' => 'n', '?' => 'n', '?' => 'o', '?' => 'o', '?' => 'p', '?' => 'p', '?' => 'r', '?' => 'r', '?' => 's',
            '?' => 's', '?' => 't', '?' => 't', '?' => 'u', '?' => 'u', '?' => 'f', '?' => 'f', '?' => 'h', '?' => 'h',
            '?' => 'c', '?' => 'c', '?' => 'ch', '?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => 'sch', '?' => 'sch',
            '?' => '', '?' => '', '?' => 'y', '?' => 'y', '?' => '', '?' => '', '?' => 'e', '?' => 'e', '?' => 'ju',
            '?' => 'ju', '?' => 'ja', '?' => 'ja');

    public static function generateUniqueName($title, $year) {
        $name_base = str_replace(array_keys(Games::$TRANSLITERATABLE_CHARACTERS),
            array_values(Games::$TRANSLITERATABLE_CHARACTERS), $title);
        $name_base = strtolower($name_base);
        $name_base = preg_replace("/[']/", '', $name_base);
        $name_base = preg_replace("/[^a-z0-9]/", '_', $name_base);

        $name_base = preg_replace('/_+/', '_',$name_base);

        if(strlen($year)>4) {
            $year = date_parse($year);
            $year = $year["year"];
        }

        $approved = false;
        $try = 0;
        while(!$approved) {
            $number_length = 0;
            if($try>0) {
                $number_length = strlen($try) + 1;
            }

            $name = substr($name_base,0, 254 - strlen($year) - $number_length);

            $name .= '_' .$year;
            if($try > 0) {
                $name .= '_' .$try;
            }

            $result = null;
            $query = new GamesQuery();

            $result = $query->findOneByName($name);
            if($result!=null) {
                $try++;
            } else {
                return $name;
            }
        }

    }

    public function getValidPlatforms() {
        $output = array();
        $results = $this->getGamePlatformssJoinPlatforms();
        foreach($results as $result) {
            array_push($output,$result->getPlatforms());
        }
        return $output;
    }

    public function getRatingHeaderForPlatform(Platforms $platform)
    {
        $query = new RatingHeaderQuery();
        $query->filterByGames($this);
        return $query->findOneByPlatformId($platform->getId());
    }

    public function getRatingForPlatform(Platforms $platform) {
        $header = $this->getRatingHeaderForPlatform($platform);
        if($header==null) {
            return Rating::getRatingForScore(-1);
        }
        return Rating::getRatingForScore($header->getScore());

    }
    public function getRatingForDefaultPlatform() {
        $platforms = $this->getValidPlatforms();
        if(sizeof($platforms)==0)
            return "n";

        $chosen_platform = $platforms[0];
        foreach($platforms as $platform) {
            if($platform->getName()=="windows") {
                $chosen_platform = $platform;
            }
        }

        $query = new RatingHeaderQuery();
        $query->filterByGames($this);
        $result = $query->findOneByPlatformId($chosen_platform->getId());
        return Rating::getRatingForScore($result->getScore());
    }


}
