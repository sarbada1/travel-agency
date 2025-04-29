<?php

namespace App\Repositories\AttributeGroup;

interface AttributeGroupInterface
{
    public function getAll();
    
    public function getById($criteria);
    
    public function insert(array $data);
    
    public function update(array $data, $id);
    
    public function delete($id);
    
    public function getActiveGroups();
}