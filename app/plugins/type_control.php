<?php

/**
 * @param $number
 * @return bool
 */
function number_control($number){
    if(is_int($number) || is_numeric($number)){
        return true;
    }

    return false;
}