<?php
namespace System;

/**
 * Loader Class
 *
 * Loads framework components.
 *
 */
class Controller {


	public function __construct()
	{

	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function loadModel($name)
	{
		require_once(APP_DIR .'models/'. strtolower($name) .'.php');

		$name = ucfirst($name);
		$name = "App\\Models\\$name";
		$model = new  $name;
		return $model;
	}



	/**
	 * @param $name
	 * @return \stdClass
	 */
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}

	/**
	 * @param $name
	 */
	public function loadPlugin($name)
	{
		require_once(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}

	/**
	 * @param $name
	 */
	public function loadHelper()
	{
		$params = func_get_args();

		$path = APP_DIR .'helpers/'. strtolower($params[0]) .'.php';

		if(is_file($path)){
			require_once($path);
		}
		else
		{
			$_SESSION['error_message'] = 'Helper File Missing';
			$this->redirect('error');
		}
		if(count($params) > 1){
			$class         = $params[0];
			return new $class($params[1]);
		}
		else{
			return new $params[0]();
		}
	}


	/**
	 * @param $loc
	 */
	public function redirect($loc)
	{
		global $config;
		
		header('Location: '. $config['base_url'] . $loc);
	}


	/**
	 * @param $template
	 * @param array $vars
	 */
    public function render($template,$vars = array()) 
    {
        
        if (file_exists(APP_DIR .'views/'. $template .'.php')) {
            extract($vars);
            ob_start();
            include (APP_DIR .'views/'. $template .'.php');
            $renderedView = ob_get_clean();
        }else{
            $renderedView = "View Dosyası Yok";
        }

        echo $renderedView;
    }



	/**
	 * @param $input
	 * @return bool|string
	 */
    function inputGet($input)
	{
    	if (!empty($_GET[$input])) {
			$ret  = strip_tags($_GET[$input]);
	    	return $ret;
		}else{
			return false;
		}
    }

	/**
	 * @param $input
	 * @return bool|string
	 */
	function inputPOST($input)
	{
		if (isset($_POST[$input])) {
			$return  = strip_tags($_POST[$input]);
	    	return $return;
		}else{
			return false;
		}
    	
    }


}

?>