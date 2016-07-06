<?php
namespace System;
use System\Loader;


/**
 * Class Core
 * @package System
 */
class Core {

    /**
     * @var \System\Loader
     */
    public $load;

    private static $instance;

    public function __construct() {
        self::$instance = $this;
        $this->load = new Loader();
    }

}