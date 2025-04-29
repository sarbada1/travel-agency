<?php

namespace App\Repositories\Ad;

interface AdPlacementInterface
{
    public function all();
    public function getById($id);
    public function insert($data);
    public function update($data, $id);
    public function delete($id);
    public function getByAdId($adId);
    public function getByPositionId($positionId);
}