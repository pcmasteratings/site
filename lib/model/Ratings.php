<?php

use Base\Ratings as BaseRatings;

/**
 * Skeleton subclass for representing a row from the 'ratings' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Ratings extends BaseRatings
{
    public static function getAllRatings() {
        $query = new RatingsQuery();
        $query->orderByThreshold();
        return $query->find();
    }

    private function test() {
        $this->getTitle();
    }
}
