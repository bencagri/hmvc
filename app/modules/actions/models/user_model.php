<?php
namespace App\Modules\Actions\Models;

use System\Core\Model;

class User_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_users(){
        return $this->db->select('users');
    }


    public function add_user($data){
        return $this->db->insert('users',$data);
    }

    public function update_user($data,$id){
        return $this->db->update('users',$data,$id);
    }


    public function delete_user($id){
        return $this->db->delete('users',$id);
    }

}