<?php


class Autoloader
{
    public static function loader($class)
    {
        $filename = $class . '.php';
        $file ='../code/classes/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
        return true;
    }
}