<?php
namespace System\Template;


/**
 * Class Template
 * @package System\Template
 */
class Template
{

    /**
     * @param $template string
     * @param $vars array
     * @return string
     */
    public static function view($template,$vars = [])
    {
        $path = '';

        //check file if inside app/views directory.if it is, use it
        if(is_file(APP_DIR ."views/{$template}.php")){
            $path = APP_DIR ."views/{$template}.php";

        //check if view file is under modules. if it is use it
        }elseif(strpos($template,'/') !== false){

            $view   = explode('/',$template); //first argument should be module name

            $module = $view[0];

            //rest of is the view file inside view dir.
            unset($view[0]);
            $view  = implode('/',$view);

            //check if view file is under module
            if(is_file(APP_DIR ."modules/{$module}/views/{$view}.php")){
                $path = APP_DIR ."modules/{$module}/views/{$view}.php";
            }

        }

        if ($path != ''  && file_exists($path)) {
            extract($vars);
            ob_start();
            require_once($path);
            echo ob_get_clean();
        }else{
            $_SESSION['error_message'] = 'View File Missing';
            redirect('error');
        }

    }

}