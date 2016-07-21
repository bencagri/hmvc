<?php
namespace System\Core;
use System\Config\Config;


/**
 * Class Loader
 * @package System\Core
 *
 * Loads views and files
 */
class Loader
{

    public $config;

    public function __construct()
    {
        self::helper('trycatch');
        self::_my_autoloader();
    }

    /**
     * Load model
     * @param $name
     * @return mixed
     */
    public static function model($name)
    {
        if(strpos($name,'/') !== false){
            $name = explode('/',$name);
            require_once(APP_DIR .'modules/'. $name[0] . '/models/'. strtolower($name[1]) .'.php');

            $module_name    = ucfirst($name[0]);
            $model_name     = ucfirst($name[1]);

            $name = "App\\Modules\\$module_name\\Models\\$model_name";
            $model = new  $name;

        }else{
            require_once(APP_DIR .'models/'. strtolower($name) .'.php');

            $name = ucfirst($name);
            $name = "App\\Models\\$name";
            $model = new  $name;
        }

        return $model;
    }



    /**
     * Load plugin
     * @param $name
     * @return mixed
     */
    public static function helper($name)
    {
        $file = APP_DIR .'helpers/'. strtolower($name) .'.php';
        if(is_file($file)){
            require_once($file);
        }
        else
        {
            $_SESSION['error_message'] = 'Helper File Missing';
            redirect('error');
        }
    }

    /**
     * Load 3rd Party Libraries
     * @return mixed
     */
    public static function library()
    {
        $params = func_get_args();

        //detect file path weather in modules or not
        if(strpos($params[0],'/') !== false){
            $name = explode('/',$params[0]);
            $file = APP_DIR .'modules/' . $name[0] . '/libraries/'. ucfirst($name[1]) .'.php';
            $helper_name = $name[1];
        }else{
            $file = APP_DIR .'libraries/'. ucfirst($params[0]) .'.php';
            $helper_name = $params[0];
        }

        if(is_file($file)){
            require_once($file);
        }
        else
        {
            $_SESSION['error_message'] = "Library File : {$params[0]} Missing";
            redirect('error');
        }
        if(count($params) > 1){
            $class         = $helper_name;
            return new $class($params[1]);
        }
        else{
            return new $helper_name();
        }
    }

    /**
     * Load Database driver
     */
    public function database(){

    }


    /**
     * Load config file
     * @param $name
     * @return mixed
     * @deprecated
     */
    public static function config($name){

        return new Config($name);
    }


    /**
     * Autoloader support
     * Loads helper,plugin and models determined on config
     */
    public static function _my_autoloader()
    {

        $config = new Config('autoload');

        $autoload = $config::get();


        if (!isset($autoload)) {
            return;
        }

        //load libraries
        if (isset($autoload['libraries'])){
            foreach ($autoload['helpers'] as $item) {
                self::library($item);
            }
        }

        //load helpers
        if (isset($autoload['helpers'])) {
            foreach ($autoload['helpers'] as $item) {
                self::helper($item);
            }
        }

        //load models
        if (isset($autoload['models'])) {
            foreach ($autoload['models'] as $item) {
                self::model($item);
            }
        }




    }

}