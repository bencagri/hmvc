<?php

spl_autoload_register("autoloader");

require_once('loader.php');
require_once('core.php');
require_once('model.php');
require_once('view.php');
require_once('controller.php');



function start_try_catch_sample_mvc()
{
    global $config;

    // Set our defaults
    $controller = $config['default_controller'];
    $action = 'index';
    $url = '';

    // Get request url and script url
    $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
    $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

    // Get our url path and trim the / of the left and the right
    if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');

    // Split the url into segments
    $segments = explode('/', $url);

    // Do our default checks
    if(isset($segments[0]) && $segments[0] != '') $controller = $segments[0];
    if(isset($segments[1]) && $segments[1] != '') $action = $segments[1];



    // Get our controller file
    $path = APP_DIR . 'controllers/' . $controller . '.php';

    if(file_exists($path)){
        require_once($path);
    } else {
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
    }

    // Set controller class name
    $_controller = ucfirst($controller);
    $_controller = "App\\Controllers\\$_controller";

    // Check the action exists
    if(!method_exists($_controller, $action)){
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
        $action = 'index';
    }

    // Create object and call method
    $obj = new $_controller();

    die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
}

/**
 * Apply Singleton Pattern
 * Access loader anywhere
 * @return \System\Core
 */
function & get_instance() {
    $instance = new System\Core;
    return $instance::get_instance();
}

/**
 * Autoload classes with PSR-0 standards
 * @param $className
 */
function autoloader($className) {
    $filename = ROOT_DIR . str_replace('\\', '/', $className) . ".php";

    if (is_readable($filename)) {
        require_once($filename);
    }
}
