<?php
namespace System;

use System\Config\Config;
use System\Core\Debug;
use System\Router\Router;


/**
 * Class Core
 * @package System
 */
class Core {
    

    /**
     * Routing
     * @var $route
     */
    public $route;

    /**
     * @var $instance
     */
    private static $instance;

    public function __construct() {
        self::$instance = $this;
    }

    /**
     * Init function
     * With routing
     */
    public static function init(){
        $config = new Config('config');

        // Set our defaults
        $controller         = $config::get('default_controller');
        $error_controller   = $config::get('error_controller');
        $action             = $config::get('default_method');
        $url                = '';


        //load configured routes
        $routes = new Config('route');
        $routes = $routes::get();

        $route = new Router();

        //set default controller and method
        $route->get("/", "{$controller}@{$action}");

        //add route rules to our router
        foreach ($routes as $mask => $r) {
            $route->add($mask,$r);
        }

        $match = $route->match(self::get_uri());

        //if module is detected
        if(is_array($match) && isset($match['module'])){
            $_module        = $match['module'];
            $controller     = $match['controller'];
            $_controller    = ucfirst($controller);
            $action         = $match['action'];
            $params         = $match['params'];

            $_c_namespace   = "App\\Modules\\{$_module}\\Controllers\\{$_controller}";

            $_c_file        = APP_DIR . "modules/{$_module}/controllers/{$controller}.php";

        //if module is not detected use default controller
        }elseif(is_array($match)){
            $controller     = $match['controller'];
            $_controller    = ucfirst($controller);
            $action         = $match['action'];
            $params         = $match['params'];

            $_c_namespace   = "App\\Controllers\\{$_controller}";
            $_c_file        = APP_DIR . "controllers/{$controller}.php";

        //if route not found try to catch controller
        }elseif(is_bool($match)){

            // Split the url into segments
            $segments = explode('/', self::get_uri());
            $params   = array_slice($segments, 2);

            // Do our default checks
            if(isset($segments[0]) && $segments[0] != '') $controller = $segments[0];
            if(isset($segments[1]) && $segments[1] != '') $action = $segments[1];

            $_controller    = ucfirst($controller);
            $_c_namespace   = "App\\Controllers\\{$_controller}";
            $_c_file        = APP_DIR . "controllers/{$controller}.php";
        }


        if(is_file($_c_file)){
            include($_c_file);
            // Check the action exists
        } else {
            //if not found load error controller
            $_c_namespace = "App\\Controllers\\{$error_controller}";

            Debug::error_message("Controller {$_controller} not found");


        }

        //if method is not exist
        if(!method_exists($_c_namespace, $action)){
            Debug::error_message("Action {$action} not found");
            $action = 'index';

        }

        // Create object and call method
        $obj = new $_c_namespace();

        die(call_user_func_array(array($obj, $action), $params));

    }


    /**
     * @return Core
     */
    public static function & get_instance() {
        return self::$instance;
    }

    /**
     * Gets uri parameters for routing
     * @return string
     */
    public static function get_uri(){

        $path = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));

        $uri  = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        foreach ($path as $key => $val) {
            if ($val == @$uri[$key]) {
                unset($uri[$key]);
            } else {
                break;
            }
        }

        // portfolio/design
        return implode('/', $uri);
    }

}