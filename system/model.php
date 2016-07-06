<?php
namespace System;
use System\Core;

/**
 * Class Model
 *
 */
class Model extends Core {

    public function __construct()
    {
        parent::__construct();
        /* Here could be mysql,mongo,redis etc. Crud operation methods */
    }

}
?>
