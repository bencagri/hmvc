<?php

namespace System\Database\Interfaces;


interface Db_interface
{
    public function select($table,$condition);

    public function select_all($table);

    public function delete($table,$id);

    public function delete_all($table);

    public function update($table, array $data, $id);

    public function insert($table,$new_data);

}