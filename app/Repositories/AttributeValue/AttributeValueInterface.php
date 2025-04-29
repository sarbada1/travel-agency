<?php

namespace App\Repositories\AttributeValue;

interface AttributeValueInterface
{
    public function getAll();
    
    public function getById($criteria);
    
    public function insert(array $data);
    
    public function update(array $data, $id);
    
    public function delete($id);
    
    public function getByAttributeAndEntity($attributeId, $entityId, $entityType);
    
    public function getForEntity($entityId, $entityType);
}