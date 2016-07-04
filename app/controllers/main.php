<?php
namespace App\Controllers;
use System\Controller;

class Main extends Controller
{

	protected $store;

	public function __construct(){
        parent::__construct();

		$this->store = $this->loadHelper('Txtdb',[
			'dir'      => APP_DIR.'cache/'
		]);

	}


	public function index(){
		$data['users'] = $this->store->select('users');
		$this->render("index",$data);
	}


}
?>