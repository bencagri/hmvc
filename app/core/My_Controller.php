<?php
namespace App\Core;

use System\Core\Controller;

class My_Controller extends Controller
{

    protected $my_var = 'This is My Controller';

    public function __construct()
    {
        parent::__construct();

        //we can extend our controllers
    }

}