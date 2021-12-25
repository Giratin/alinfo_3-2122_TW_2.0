<?php

class config
{
    private static $instance = NULL;

    public static function getConnexion()
    {
        try{
            if (!isset(self::$instance)) {
                self::$instance = new PDO('mysql:host=localhost;dbname=clubEsprit;port=8889', 'root', 'root');
            }
            return self::$instance;
        }catch(Exception $ex){
            die("Could not connect ". $ex->getMessage());
        }

    }

}