<?php

use Base\Rating as BaseRating;

/**
 * Skeleton subclass for representing a row from the 'rating' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Rating extends BaseRating
{
    public static function getAllRatings() {
        $query = new RatingsQuery();
        $query->orderByThreshold();
        return $query->find();
    }

    public static function getRatingForScore($score) {
        return RatingsQuery::create()
            ->where('Ratings.Threshold <= ?',$score)
            ->orderByThreshold("DESC")
            ->findOne();
    }

    private function test() {
        $this->getTitle();
    }
}
