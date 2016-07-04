<?php
/**
 * Sample For Try Catch
 */

//Start the Session
session_start(); 

// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'app/');

// Includes
require(APP_DIR .'config/config.php');
require(ROOT_DIR .'system/model.php');
require(ROOT_DIR .'system/view.php');
require(ROOT_DIR .'system/controller.php');
require(ROOT_DIR .'system/core.php');

// Define base URL
global $config;
define('BASE_URL', $config['base_url']);

//
start_try_catch_sample_mvc();

?>
