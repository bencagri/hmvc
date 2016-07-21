<?php
namespace App\Models;

use System\Core\Model;

class Sample extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_users(){
        return $this->db->select('users');
    }


}