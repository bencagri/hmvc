<?php
/**
 * Database Driver, mysql, mysqli, pdo, txtdb etc.
 * In this case I prefer txtdb
 */
$config['database']['driver'] = 'txtdb';


/**
 * To support mysql master-slave replication
 * Can be loaded inside models
 */
$config['database']['default_group'] = 'master';



/**
 * Master Database Configuration
 * This could be dublicated for slave replication
 */
$config['database']['master'] = [
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => APP_DIR.'cache/',
    'port'     => '',
    'encrypt'  => false,
];



