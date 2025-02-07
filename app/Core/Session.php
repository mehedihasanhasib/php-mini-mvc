<?php

namespace App\Core;

class Session
{
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION["_flash"][$key] ?? $_SESSION[$key] ?? null;
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]) || isset($_SESSION["_flash"][$key]);
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function flash($key, $value)
    {
        $_SESSION["_flash"][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION["_flash"]);
    }

    public static function flush()
    {
        $_SESSION = [];
    }
}
