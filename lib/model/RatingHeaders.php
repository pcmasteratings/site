<?php

use Base\RatingHeaders as BaseRatingHeaders;

/**
 * Skeleton subclass for representing a row from the 'rating_headers' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class RatingHeaders extends BaseRatingHeaders
{
    public function getRating() {
        $query = new RatingsQuery();
        $query->orderByThreshold("DESC");
        $query->limit(1);
        $query->where("threshold <= " . $this->getScore());
        return $query->findOne();
    }

    public function getRatingForCategory(RatingCategories $category) {
        return RatingCategoryValuesQuery::create()->filterByRatingHeaders($this)->findOneByRatingCategoryId($category->getId());
    }
}
