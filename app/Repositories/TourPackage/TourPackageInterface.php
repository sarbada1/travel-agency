<?php

namespace App\Repositories\TourPackage;

interface TourPackageInterface
{
    public function getAll();
    
    public function getById($criteria);
    
    public function insert(array $data);
    
    public function update(array $data, $id);
    
    public function delete($id);
    
    public function getFeatured();
    
    public function getPopular();
    
    public function getByCategoryId($categoryId);
    
    public function getByDestinationId($destinationId);
    
    public function getWithAttributes($packageId);
}