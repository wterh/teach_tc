<?php
mb_internal_encoding('UTF-8');
error_reporting(E_ALL);
date_default_timezone_set('Europe/Moscow');

// Считаю время на работу
$GLOBALS['workTime'] = microtime(true);
// Замеряем потребление памяти
$GLOBALS['workMemory'] = memory_get_usage();

const BASE_DIR = __DIR__;

// autoload
spl_autoload_register(function ($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class . '.php');
    $fullPath = BASE_DIR . DIRECTORY_SEPARATOR . $path;

    if (file_exists($fullPath)) {
        require_once "{$fullPath}";
    }
});