<?php
namespace App\Modules\Routed\Controllers;

use System\Core\Controller;
use System\Core\Loader;

/**
 * Class Routed
 * @package App\Modules\Routed\Controllers
 *
 * This is sample module for routing
 */
class Routed extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    function index(){
        $sample = Loader::helper('routed/sample');
        $sample->set(['Mercedes' => ['model' => 'CLK']]);

        var_dump($sample->get('Mercedes'));
    }

    function test(){
        echo "Hello! I'm routed";
    }

}