<?php

use Illuminate\Http\RedirectResponse;

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
        $session = '';
        if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
            $session = $_SESSION[$key];
        }

        return $session;
    }
}

if (!function_exists('setSession')) {
    function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
        return $value;
    }
}

if (!function_exists('redirect')) {
    function redirect($patch)
    {
        $response = new RedirectResponse($patch);
        $response->send();
        return;
    }
}
