<?php

namespace App\Repositories\Ad;

interface AdPositionInterface
{
    public function all();
    public function getById($id);
    public function insert($data);
    public function update($data, $id);
    public function delete($id);
}