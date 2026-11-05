<?php
/**
 * Echoes the request like the TRACE method of a web server does, for
 * servers that do not implement TRACE themselves (PHP's built-in server).
 */
if (function_exists('getallheaders')) {
    header('Content-Type: message/http');
    echo $_SERVER['REQUEST_METHOD'], ' ', $_SERVER['REQUEST_URI'], ' ', $_SERVER['SERVER_PROTOCOL'], "\r\n";
    foreach (getallheaders() as $name => $value) {
        echo $name, ': ', $value, "\r\n";
    }
    echo "\r\n";
}
