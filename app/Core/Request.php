<?php

namespace App\Core;
class Request {
    public static function uri()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $url;
        $url = str_replace(home(), '', $url);
        return trim($url, '/');
    }

    public static function get($key, $default = null)
    {
        return $_GET[$key] ?? $_POST[$key] ?? $default;
    }
    public static function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']); // get or post.
    }
}