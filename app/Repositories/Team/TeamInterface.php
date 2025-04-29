<?php

namespace App\Repositories\Team;

interface TeamInterface
{


    public function all();


    public function insert($data);


    public function update($data, $id);


    public function delete($id);


    public function find($id);

    public function getMemberType();


}
