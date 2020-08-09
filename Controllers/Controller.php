<?php

session_start();

class Controller extends Database {

    public static function CreateView($viewName, array $vars = array()){
        extract($vars);
        ob_start();
        require("./Views/$viewName.php");
        echo ob_get_clean();
    }

    public static function getUrl()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI'];
    }
}
?>