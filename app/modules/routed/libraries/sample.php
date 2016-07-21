<?php
namespace App\Modules\Routed\Helpers;

/**
 * Class Sample
 * @package App\Modules\Routed\Helpers
 *
 * This is sample helper for routed module
 */
class Sample {

    public $car;


    /**
     * @param $name array|string
     * @return void
     */
    function set($name){
        if(is_array($name)){
            foreach ($name as $key => $item) {
                $this->car[$key] = $item;
            }
        }else{
            $this->car[$name] = $name;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    function get($name){
        return isset($this->car[$name]) ? $this->car[$name] : NULL;
    }
}