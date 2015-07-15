<?php

use Base\UserAccess as BaseUserAccess;

/**
 * Skeleton subclass for representing a row from the 'user_access' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserAccess extends BaseUserAccess
{
    public static function addUserEvent(User $user, $ip, $eventType)
    {
        switch($eventType)
        {
            case UserAccessType::login:
            case UserAccessType::addreview:
            case UserAccessType::editreview:
                break;
            default:
                throw new Exception('invalid event type.');
        }


        $event = new UserAccess();

        $event->setUser($user);
        $event->setIpv4Address($ip);
        $event->setUserAccessType(
            UserAccessTypeQuery::create()->findOneByType($eventType)
        );
        $datetime = new DateTime();
        $datetime->getTimestamp();
        $event->setAccess($datetime);
        $event->save();

    }
}
