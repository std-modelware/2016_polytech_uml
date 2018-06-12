<?php

class AccountSessionData
{
    const KEY = "account";

    public $id;
    public $email;
}

class Session
{
    private static $session = NULL;

    const SESSION_NAME = "tm";

    private function __construct()
    {
        session_name(Session::SESSION_NAME);
        session_start();
    }

    static public function getInstance()
    {
        if (is_null(self::$session)) {
            self::$session = new Session();
        }
        return self::$session;
    }

    public function reset()
    {
        $_SESSION = array();
        unset($_COOKIE[session_name()]);
        session_destroy();
        self::$session = NULL;
    }

    public function setValueByKey($key, $value)
    {
        $_SESSION [$key] = $value;
    }

    public function getValueByKey($key)
    {
        if (array_key_exists($key, $_SESSION))
            return $_SESSION [$key];
        else
            return NULL;
    }

    public function deleteValueByKey($key)
    {
        unset($_SESSION [$key]);
    }

}