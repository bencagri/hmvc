<?php
namespace App\Modules\Actions\Controllers;
use System\Core\Controller;
use System\Core\Loader;

/**
 * Class Actions
 * @package App\Controllers
 */
class Actions extends Controller
{

    protected $store,$rest;
    protected $table = 'users';  //our default data table

    public function __construct()
    {
        parent::__construct();

        //call our model to use on every method
        $this->store = Loader::model('actions/user_model');

        $this->rest  = Loader::library('Rest_Server');

        Loader::helper('type_control');

    }



    /**
     * Lists All records of table
     * @method GET
     * @param table
     * @return string
     */
    public function index(){
        if($this->inputGet('table')){
            $this->table = $this->inputGet('table');
        }

        $data = $this->store->get_users();

        if(empty($data)){
            $response = [
                'status' => 'error',
                'message' => 'No Records Found'
            ];

            return $this->rest->response($response,$this->rest->get_status('HTTP_NOT_FOUND'));

        }else{
            $response = [
                'status' => 'success',
                'data'   => $data
            ];

            return $this->rest->response($response);

        }

    }


    /**
     * Add record
     * @method POST
     * @param name
     * @param email
     * @param number
     * @return string
     */
    public function add(){
        $errors = [];

        $data['name']   = false !== $this->inputPOST('name')    ? $this->inputPOST('name')  : $errors[] = 'name is required';
        $data['email']  = false !== $this->inputPOST('email')   ? $this->inputPOST('email') : $errors[] = 'email is required';
        $data['number'] = false !== $this->inputPOST('number')  ? $this->inputPOST('number'): $errors[] = 'number is required';
        $data['number'] = number_control($data['number'])       ? $data['number']           : $errors[] = 'number must be numeric';


        if(count($errors) > 0){

            if(count($errors) == 1){
                $message = implode(',',$errors);
            }else{
                $message = implode(',',$errors);
            }

            $response = ['status' => 'error', 'message' => $message ];

            return $this->rest->response($response,$this->rest->get_status('HTTP_BAD_REQUEST'));

        }else{

            $insert = $this->store->add_user($data);

            if($insert){
                $response = ['status' => 'success', 'data' => ['id' => $insert]];

                return $this->rest->response($response);
            }else{
                $response = ['status' => 'error', 'message' => 'Internal Server Error.'];

                return $this->rest->response($response,$this->rest->get_status('HTTP_INTERNAL_SERVER_ERROR'));
            }

        }

    }



    /**
     * Update record by id
     * @method POST
     * @param id required
     * @return string
     */

    public function update(){
        $errors = [];

        $id  =  $this->inputPOST('id') ? $this->inputPOST('id') : $errors[] = 'id';

        if($this->inputPOST('name')){
            $data['name'] = $this->inputPOST('name');
        }

        if($this->inputPOST('number')){
            $data['number'] = $this->inputPOST('number');
        }

        if($this->inputPOST('email')){
            $data['email'] = $this->inputPOST('email');
        }


        if(count($data) < 1){

            $response = ['status' => 'error', 'message' => "Provide at least one value." ];

            return $this->rest->response($response,$this->rest->get_status('HTTP_BAD_REQUEST'));

        }else{
            $insert = $this->store->update_user($data,$id);

            if($insert){
                $response = ['status' => 'success', 'data' => ['id' => $insert]];

                return $this->rest->response($response);
            }else{
                $response = ['status' => 'error', 'message' => 'Internal Server Error.'];

                return $this->rest->response($response,$this->rest->get_status('HTTP_INTERNAL_SERVER_ERROR'));
            }

        }
    }



    /**
     * Delete record by id
     * @method POST
     * @param id required
     * @return string
     */

    public function delete(){

        $id  =  $this->inputPOST('id') ? $this->inputPOST('id') : false;

        if(!$id){

            $message = 'id is requried.';

            $response = ['status' => 'error', 'message' => $message ];

            return $this->rest->response($response,$this->rest->get_status('HTTP_BAD_REQUEST'));

        }else{

            $delete = $this->store->delete_user($id);

            if($delete !== false){
                $response = ['status' => 'success', 'message' => 'Record has been deleted'];

                return $this->rest->response($response);
            }else{
                $response = ['status' => 'error', 'message' => 'Internal Server Error.'];

                return $this->rest->response($response,$this->rest->get_status('HTTP_INTERNAL_SERVER_ERROR'));
            }

        }

    }
}