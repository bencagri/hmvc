<?php
namespace App\Controllers;

use System\Core\Loader;
use System\Template\Template;
use App\Core\My_Controller;

class Main extends My_Controller
{


	public function __construct(){
        parent::__construct();

	}

	public function index(){

		$model = Loader::model('actions/user_model');

		$data['users'] = $model->get_users();

		Template::view("index",$data);
	}


}
?>