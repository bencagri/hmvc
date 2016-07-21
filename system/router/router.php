<?php
namespace System\Router;

use System\Router\Node;


/**
 * Class Router
 * @package System\Router
 */
class Router {

    public  $method_get     = "GET";
    public  $method_post    = "POST";
    public  $method_put     = "PUT";
    public  $method_delete  = "DELETE";

    protected $nodes;

    /**
     * Router constructor.
     */
    function __construct(){
        $this->nodes = new Node();
    }

    /**
     * @param $route
     * @param $resource
     */
    public function get($route, $resource){
        $this->add($route, $resource,$this->method_get);
    }


    /**
     * @param $method
     * @param $route
     * @param $resource
     */
    public function add($route, $resource,$method = 'GET'){
        $route = trim($route, "/");
        $fragments = explode("/", $route);

        //Root is defined as / instead of empty space
        if(count($fragments) === 1 && $fragments[0] == ""){
            $fragments[0] = "/";
        }

        $parent = $this->nodes;

        foreach($fragments as $piece){
            if($node = $parent->get_child($piece)){
                $parent = $node;
            }
            else{
                $node = new Node();
                $node->set_fragment($piece);
                $parent->add_child($node);
                $parent = $node;
            }
        }

        $parent->add_route($method, $resource);
    }

    /**
     * @param $method
     * @param $route
     * @return array|bool array if correct match found, true if endpoint found but not for METHOD, false if nothing was found
     */
    public function match($route,$method='GET'){
        if(!is_array($route)){
            $route = trim($route, "/");
            $route = explode("/", $route);

            //Root is defined as / instead of empty space
            if(count($route) === 1 && $route[0] == ""){
                $route[0] = "/";
            }
        }
        //If the route is left empty, we assume that it is ROOT
        else if(empty($route)){
            $route = ["/"];
        }

        $node = $this->nodes;
        $params = [];

        foreach($route as $fragment){
            //Search for fragment as pre-defined piece of the URI
            $child = $node->get_child($fragment);
            if($child === false){

                //Search for fragment as a parameter of the URI
                $child = $node->get_child("(:any)");
                if($child === false){
                    return false;
                }

                $params[] = $fragment;
            }

            $node = $child;
        }

        $routes = $node->get_routes();
        if(isset($routes[$method])){
            $route = explode("@", $routes[$method]);

            //check if module is set
            if(count($route) == 3){
                $route = [
                    "module"        => $route[0],
                    "controller"    => $route[1],
                    "action"        => $route[2],
                    "params"        => $params
                ];
            }else{
                $route = [
                    "controller"    => $route[0],
                    "action"        => $route[1],
                    "params"        => $params
                ];
            }


            return $route;
        }
        else if(count($routes) > 0){
            return true;
        }
        else{
            return false;
        }
    }
}