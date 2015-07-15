<?php

use Base\UserAccessType as BaseUserAccessType;

/**
 * Skeleton subclass for representing a row from the 'user_access_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserAccessType extends BaseUserAccessType
{
    const login = 'login';
    const addreview = 'addreview';
    const editreview = 'editreview';
}
