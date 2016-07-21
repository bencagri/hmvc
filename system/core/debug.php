<?php
namespace System\Core;


class Debug extends \Exception
{

    public static function error_message($text){
        $_SESSION['error_message'] = $text;
        require_once(APP_DIR . "controllers/error.php");
    }

}