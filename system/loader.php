<?php
namespace System;
use System\Interfaces\Loader_Interface;

/**
 * Loader Class
 *
 */
class Loader
{


    public function __construct()
    {
        $this->plugin('trycatch');
        $this->_my_autoloader();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function model($name)
    {
        require_once(APP_DIR .'models/'. strtolower($name) .'.php');

        $name = ucfirst($name);
        $name = "App\\Models\\$name";
        $model = new  $name;
        return $model;
    }


    /**
     * @param $template string
     * @param $vars array
     * @return string
     */
    function view($template,$vars = [])
    {

        if (file_exists(APP_DIR .'views/'. $template .'.php')) {
            extract($vars);
            ob_start();
            include (APP_DIR .'views/'. $template .'.php');
            echo ob_get_clean();
        }else{
            $_SESSION['error_message'] = 'View File Missing';
            redirect('error');
        }

    }

    /**
     * @param $name
     */
    public function plugin($name)
    {
        require_once(APP_DIR .'plugins/'. strtolower($name) .'.php');
    }

    /**
     * helper loader
     */
    public function helper()
    {
        $params = func_get_args();

        $file = APP_DIR .'helpers/'. strtolower($params[0]) .'.php';

        if(is_file($file)){
            require_once($file);
        }
        else
        {
            $_SESSION['error_message'] = 'Helper File Missing';
            redirect('error');
        }
        if(count($params) > 1){
            $class         = $params[0];
            return new $class($params[1]);
        }
        else{
            return new $params[0]();
        }
    }

    protected function _my_autoloader()
    {
        if (is_file(APP_DIR . 'config/autoload.php')) {
            require_once(APP_DIR . 'config/autoload.php');
        }

        if (!isset($autoload)) {
            return;
        }

        //load helpers
        if (isset($autoload['helpers'])){
            foreach ($autoload['helpers'] as $item) {
                $this->helper($item);
            }
        }

        //load plugins
        if (isset($autoload['plugins'])) {
            foreach ($autoload['plugins'] as $item) {
                $this->plugin($item);
            }
        }

        //load models
        if (isset($autoload['models'])) {
            foreach ($autoload['models'] as $item) {
                $this->model($item);
            }
        }

    }

}