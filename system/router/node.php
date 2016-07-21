<?php
namespace System\Router;

class Node{
    protected $fragment;
    protected $routes = [];
    protected $children = [];

    public function get_routes() {
        return $this->routes;
    }

    public function add_route($method, $target){
        $this->routes[$method] = $target;
    }

    public function get_route($method){
        if(isset($this->routes[$method]))
            return $this->routes[$method];
        return false;
    }

    public function set_fragment($fragment){
        $this->fragment = $fragment;
    }

    public function get_fragment(){
        return $this->fragment;
    }

    public function get_children() {
        return $this->children;
    }

    public function add_child(Node $child){
        $this->children[$child->get_fragment()] = $child;
    }

    public function get_child($child){
        if(isset($this->children[$child]))
            return $this->children[$child];
        return false;
    }
}