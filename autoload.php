<?php

function __autoload($name) {
    $file_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . "{$name}.php";
    if (!file_exists($file_path)) {
        return false;
    }
    require_once($file_path);
    return true;
}