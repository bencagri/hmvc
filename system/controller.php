<?php
namespace System;

/**
 * Loader Class
 *
 * Loads framework components.
 *
 * HTTP Status Codes Taken From :
 * https://github.com/chriskacerguis/codeigniter-restserver/blob/master/application/libraries/REST_Controller.php#L23
 *
 */
class Controller {

	/**
	 * The request has succeeded
	 */
	const HTTP_OK = 200;

	/**
	 * The server successfully created a new resource
	 */
	const HTTP_CREATED = 201;
	const HTTP_ACCEPTED = 202;
	const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
	/**
	 * The server successfully processed the request, though no content is returned
	 */
	const HTTP_NO_CONTENT = 204;
	const HTTP_RESET_CONTENT = 205;
	const HTTP_PARTIAL_CONTENT = 206;
	const HTTP_MULTI_STATUS = 207;          // RFC4918
	const HTTP_ALREADY_REPORTED = 208;      // RFC5842
	const HTTP_IM_USED = 226;               // RFC3229
	// Redirection
	const HTTP_MULTIPLE_CHOICES = 300;
	const HTTP_MOVED_PERMANENTLY = 301;
	const HTTP_FOUND = 302;
	const HTTP_SEE_OTHER = 303;
	/**
	 * The resource has not been modified since the last request
	 */
	const HTTP_NOT_MODIFIED = 304;
	const HTTP_USE_PROXY = 305;
	const HTTP_RESERVED = 306;
	const HTTP_TEMPORARY_REDIRECT = 307;
	const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238
	// Client Error
	/**
	 * The request cannot be fulfilled due to multiple errors
	 */
	const HTTP_BAD_REQUEST = 400;
	/**
	 * The user is unauthorized to access the requested resource
	 */
	const HTTP_UNAUTHORIZED = 401;
	const HTTP_PAYMENT_REQUIRED = 402;
	/**
	 * The requested resource is unavailable at this present time
	 */
	const HTTP_FORBIDDEN = 403;
	/**
	 * The requested resource could not be found
	 *
	 * Note: This is sometimes used to mask if there was an UNAUTHORIZED (401) or
	 * FORBIDDEN (403) error, for security reasons
	 */
	const HTTP_NOT_FOUND = 404;

	/**
	 * The request method is not supported by the following resource
	 */
	const HTTP_METHOD_NOT_ALLOWED = 405;
	/**
	 * The request was not acceptable
	 */
	const HTTP_NOT_ACCEPTABLE = 406;
	const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
	const HTTP_REQUEST_TIMEOUT = 408;
	/**
	 * The request could not be completed due to a conflict with the current state
	 * of the resource
	 */
	const HTTP_CONFLICT = 409;
	const HTTP_GONE = 410;
	const HTTP_LENGTH_REQUIRED = 411;
	const HTTP_PRECONDITION_FAILED = 412;
	const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
	const HTTP_REQUEST_URI_TOO_LONG = 414;
	const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
	const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
	const HTTP_EXPECTATION_FAILED = 417;
	const HTTP_I_AM_A_TEAPOT = 418;                                               // RFC2324
	const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
	const HTTP_LOCKED = 423;                                                      // RFC4918
	const HTTP_FAILED_DEPENDENCY = 424;                                           // RFC4918
	const HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
	const HTTP_UPGRADE_REQUIRED = 426;                                            // RFC2817
	const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
	const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
	const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585
	// Server Error
	/**
	 * The server encountered an unexpected error
	 *
	 * Note: This is a generic error message when no specific message
	 * is suitable
	 */
	const HTTP_INTERNAL_SERVER_ERROR = 500;
	/**
	 * The server does not recognise the request method
	 */
	const HTTP_NOT_IMPLEMENTED = 501;
	const HTTP_BAD_GATEWAY = 502;
	const HTTP_SERVICE_UNAVAILABLE = 503;
	const HTTP_GATEWAY_TIMEOUT = 504;
	const HTTP_VERSION_NOT_SUPPORTED = 505;
	const HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;                        // RFC2295
	const HTTP_INSUFFICIENT_STORAGE = 507;                                        // RFC4918
	const HTTP_LOOP_DETECTED = 508;                                               // RFC5842
	const HTTP_NOT_EXTENDED = 510;                                                // RFC2774
	const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;

	protected $http_status_codes = [
		self::HTTP_OK => 'OK',
		self::HTTP_CREATED => 'CREATED',
		self::HTTP_NO_CONTENT => 'NO CONTENT',
		self::HTTP_NOT_MODIFIED => 'NOT MODIFIED',
		self::HTTP_BAD_REQUEST => 'BAD REQUEST',
		self::HTTP_UNAUTHORIZED => 'UNAUTHORIZED',
		self::HTTP_FORBIDDEN => 'FORBIDDEN',
		self::HTTP_NOT_FOUND => 'NOT FOUND',
		self::HTTP_METHOD_NOT_ALLOWED => 'METHOD NOT ALLOWED',
		self::HTTP_NOT_ACCEPTABLE => 'NOT ACCEPTABLE',
		self::HTTP_CONFLICT => 'CONFLICT',
		self::HTTP_INTERNAL_SERVER_ERROR => 'INTERNAL SERVER ERROR',
		self::HTTP_NOT_IMPLEMENTED => 'NOT IMPLEMENTED'
	];

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
	 * @return View
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
	 * @param $data
	 * @param int $status_code
	 */
	public function response($data,$status_code = self::HTTP_OK)
	{
		http_response_code($status_code);
		header('Content-Type: application/json');
		echo json_encode($data);
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