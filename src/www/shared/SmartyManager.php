<?php
require_once(dirname(__FILE__) . "/../../3rd/smarty/Smarty.class.php");

class SmartyManager
{
    public static $smarty;

    public static function GetInstance() {
        if (is_null(self::$smarty)) {
            self::$smarty = new Smarty;
//            $smarty->force_compile = true;
            self::$smarty->debugging = false;
            self::$smarty->caching = false;
            self::$smarty->cache_lifetime = 120;
        }

        return self::$smarty;
    }
}