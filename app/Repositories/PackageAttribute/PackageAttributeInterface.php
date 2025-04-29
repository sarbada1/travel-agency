<?php

namespace App\Repositories\PackageAttribute;

interface PackageAttributeInterface
{
    public function getAll();
    
    public function getById($criteria);
    
    public function insert(array $data);
    
    public function update(array $data, $id);
    
    public function delete($id);
    
    public function getByGroup($groupId);
    
    public function getFilterableAttributes();
}