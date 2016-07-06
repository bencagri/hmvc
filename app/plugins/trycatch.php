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


/**
 * Test function for singleton pattern
 * @param $helper
 */
function load_helper($helper){
    $c = & get_instance();
    $c->load->helper($helper);
}