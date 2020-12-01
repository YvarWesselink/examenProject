<?php


class Route
{
    // hier hoeft verder geen code bij!
    public static $validRoutes = array();

    public static function set($route, $function)
    {
        self::$validRoutes[] = $route;

        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }
}