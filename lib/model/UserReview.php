<?php

use Base\UserReview as BaseUserReview;

/**
 * Skeleton subclass for representing a row from the 'user_review' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserReview extends BaseUserReview
{
    public static function getUserReview(Games $game, Platforms $platform, User $user) {
        $query = new UserReviewsQuery();
        $query->filterByGames($game);
        $query->filterByPlatforms($platform);
        $query->filterByUser($user);
        $result = $query->findOne();
        return $result;
    }
    public static function checkIfUserReviewed(Games $game, Platforms $platform, User $user) {
        $result = self::getUserReview($game, $platform, $user);
        if($result==null) {
            return false;
        }
        return true;
    }
}
