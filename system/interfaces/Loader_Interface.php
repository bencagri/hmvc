<?php
namespace System\Interfaces;

interface Loader_Interface
{

    public function model($name);

    public function helper();

    public function plugin($name);

    public function view($template,$vars=[]);

    public function _my_autoloader();

}