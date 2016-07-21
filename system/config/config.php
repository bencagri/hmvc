<?php

namespace System\Config;


/**
 * Class Config
 * @package System\Config
 *
 * Load config files, get values and set values
 */


/**
 * USAGE:
 *
 *     $foo = new Config('bar');
 *
 *     This will loads bar.php and returns $config['bar'];
 *     Now, You can use Config::set() and Config::get() methods
 *
 */
class Config
{
    /**
     * @var array
     */
    private static $config = array();

    /**
     * Config Key
     * @var
     */

    private static $key;
    /**
     * Config constructor.
     * @param $name
     */
    public function __construct($name){
        global $config;
        self::initialize($name);

    }


    /**
     * Initialize config loader
     * @param $name
     * @return bool|null
     */
    public static function initialize($name){
        self::$key = $name;
        //detect file path weather in modules or not
        if(strpos($name,'/') !== false){
            $name = explode('/',$name);
            $file = APP_DIR .'modules/' . $name[0] . '/config/'. $name[1] .'.php';

        }else{
            $file = APP_DIR .'config/'. $name .'.php';
        }

        if(is_file($file)){
            include($file);

            if ( ! isset($config) OR ! is_array($config))
            {
                die('Your '.$file.' file does not appear to contain a valid configuration array.');
            }

            self::set($name,$config[$name]);
            return self::get($name);

        }else{
            return false;
        }
    }


    /**
     * @param $name
     * @return null
     */
    public static function get($name=''){
        //if name is empty return all values
        if($name == ''){
            return static::$config[self::$key];
        }else{
            if(isset(static::$config[self::$key][$name])){
                return static::$config[self::$key][$name];
            }else{
                return NULL;
            }
        }

    }


    /**
     * @param $key
     * @param $value
     */
    public static function set($key,$value){
        static::$config[$key] = $value;

        return;
    }



}