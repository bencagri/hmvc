<?php
namespace  System\Database\Drivers;
use System\Database\Database;


/**
 * Class Mysql
 * @package System\Database\Drivers
 *
 * There may be a query builder
 */
class Mysql_driver extends Database
{

    protected $config;

    protected $conn;

    public $charset = 'utf8';

    public function __construct($config)
    {

        $this->conn = mysqli_connect($config['hostname'], $config['username'], $config['password']) or die('Couldnt Connect Mysql');
        if($this->conn):
            mysqli_select_db($this->conn,$config['database']) or die("<b>{$config['database']}</b> could not be found");
            $this->query('SET NAMES '.$this->charset);
        endif;
    }


    public function query($query){

    }

    public function insert($table,$data){

    }

    public function select($table,$condition = NULL){

    }

    public function delete($table,$id=NULL){

    }

    public function update($table, array $data,array $condition){

    }


}