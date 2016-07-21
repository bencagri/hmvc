<?php
spl_autoload_register("autoloader");

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

/**
 * Apply Singleton Pattern
 * Access loader anywhere
 * @return \System\Core
 */
function & get_instance() {
    $instance = new System\Core;
    return $instance::get_instance();
}