<?php
/**
 * Common Functions for project
 */


/**
 * @param $loc string
 */
function redirect($loc){
    global $config;
    header('Location: '. $config['base_url'] . $loc);
}