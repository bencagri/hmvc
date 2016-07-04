<?php
namespace App\Controllers;
use System\Controller;

class Error extends Controller {


	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->error404();
	}
	
	public function error404()
	{
		$this->render('error/error');

	}
    
}

?>
