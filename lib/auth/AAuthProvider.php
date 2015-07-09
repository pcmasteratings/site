<?php
/**
 * Created by PhpStorm.
 * User: sanmadjack
 * Date: 6/28/2015
 * Time: 9:46 AM
 */

abstract class AAuth {
    protected static $SESSION_REQUEST_ID = "REQUEST_ID";

    protected function createAuthRequestID() {
        $id = $this->generateRandomString (32);


        $_SESSION[self::$SESSION_REQUEST_ID] = $id;

        return $id;
    }

    protected function checkForAuthRequestID($request_id) {
        if(isset($_SESSION[self::$SESSION_REQUEST_ID])&&$_SESSION[self::$SESSION_REQUEST_ID]==$request_id) {
            unset($_SESSION[self::$SESSION_REQUEST_ID]);
            return true;
        } else {
            unset($_SESSION[self::$SESSION_REQUEST_ID]);
            return false;
        }

    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function setUser($reddit_id, $name)
    {
        $query = new UserQuery();

        $users = $query->findByRedditID($reddit_id);
        $user = null;
        if($users->count()==0) {
            $user = new User();
            $user->setUsername($name);
            $user->setRedditID($reddit_id);
            $user->save();
        } else {
            $user = $users->getFirst();
        }
        $_SESSION[Auth::$SESSION_USER_ID] = $user->getId();
    }
}