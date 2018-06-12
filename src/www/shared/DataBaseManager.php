<?php

class DataBaseManager
{
    // DSN для подключения
    public static $dsn = 'mysql:127.0.0.1;port=3306;dbname=tm;charset=UTF8;unix_socket=/tmp/mysql.sock';
    public static $user = 'tm';
    public static $pass = 'tm2016';
    public static $driverOpts = null;

    private static $db;

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    public static function GetInstance()
    {
        if (is_null(self::$db)) {
            self::$db = new PDO(self::$dsn, self::$user, self::$pass, self::$driverOpts);
            self::$db->exec('SET NAMES "uft8"');
        }
        return self::$db;
    }

    public static function DebugStrParams($q)
    {
        ob_start();
        $q->debugDumpParams();
        $r = ob_get_contents();
        ob_end_clean();
        return $r;
    }
}