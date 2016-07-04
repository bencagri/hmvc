<?php
namespace App\Controllers;
use System\Controller;

class Main extends Controller
{

	public function __construct(){
        parent::__construct();

	}

	public function index(){
		$this->render("index");
	}
}
?>