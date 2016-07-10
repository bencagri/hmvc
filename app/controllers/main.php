<?php
namespace App\Controllers;
use System\Controller;

class Main extends Controller
{

	protected $store;

	public function __construct(){
        parent::__construct();

		$this->store = $this->load->helper('Txtdb',[
			'dir'  => APP_DIR.'cache/'
		]);

	}


	public function index(){

		//function inside autoloaded plugin
		//var_dump(number_control(2));

		$data['users'] = $this->store->select('users');
		$this->load->view("index",$data);
	}


}
?>