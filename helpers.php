<?php

if (!function_exists('url')) {

    function url($path = '')
    {
        $baseUrl = $_ENV['URL_BASE'];

        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('session')) {
    function session($key)
    {
        $session = $_SESSION[$key];
        return $session;
    }
}
