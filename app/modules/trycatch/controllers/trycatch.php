<?php
namespace App\Modules\Trycatch\Controllers;

use App\Core\My_Controller;
use System\Config\Config;


class Trycatch extends My_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    function index(){
        $config = Config::get('trycatch/foo');
        echo 'Hello';
    }

}