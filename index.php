<?php
/**
 * Sample For Try Catch
 */

//Start the Session
session_start(); 

//
define('ENVIRONMENT','development');


define('DS',DIRECTORY_SEPARATOR);
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'app/');

// Includes
require(APP_DIR .'config/config.php');
require(ROOT_DIR .'system/init.php');

// Define base URL
global $config;
define('BASE_URL', $config['config']['base_url']);


//Run
System\Core::init();