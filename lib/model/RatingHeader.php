<?php

use Base\RatingHeader as BaseRatingHeader;

/**
 * Skeleton subclass for representing a row from the 'rating_header' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class RatingHeader extends BaseRatingHeader
{
    public function getRating() {
        $query = new RatingQuery();
        $query->orderByThreshold("DESC");
        $query->limit(1);
        $query->where("threshold <= " . $this->getScore());
        return $query->findOne();
    }

    public function getRatingForCategory(Category $category) {
        return RatingValueQuery::create()->filterByRatingHeader($this)->findOneByCategoryId($category->getId());
    }
}
