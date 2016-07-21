<?php
namespace System\Core;
use System\Core;

/**
 * Controller Class
 *
 */
class Controller extends Core{


	public function __construct()
	{
		parent::__construct();

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