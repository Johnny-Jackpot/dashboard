<?php

spl_autoload_register(function ($className) {
    $arrPaths = [
        '/models/',
        '/components/',
        '/controllers/'
    ];
    
    foreach ($arrPaths as $path) {
        $path = ROOT . $path . $className . '.php';
        if (is_file($path)) {
            include_once($path);
        }
    }
});