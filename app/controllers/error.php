<?php
namespace App\Controllers;
use System\Core\Controller;
use System\Template\Template;

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
		Template::view('error/error');

	}
    
}

?>
