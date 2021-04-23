<?php
spl_autoload_register(function($className) {
    $file = $className . '.php';

    if (file_exists('./classes/'.$className.'.php')) {
        require_once './classes/'.$className.'.php';
    } else if (file_exists('./controller/'.$className.'.php')) {
        require_once './controller/'.$className.'.php';
    }
});