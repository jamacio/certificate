<?php
// app/helpers.php

if (!function_exists('url')) {
    /**
     * Gera uma URL baseada na URL base do projeto.
     *
     * @param string $path
     * @return string
     */
    function url($path = '')
    {
        // Define a URL base do seu projeto
        $baseUrl = 'http://localhost:8002'; // Ajuste para a URL base do seu projeto

        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}
