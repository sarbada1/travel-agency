<?php

namespace App\Repositories\Ad;

interface AdInterface
{
    public function all();
    public function getById($id);
    public function insert($data);
    public function update($data, $id);
    public function delete($id);
    public function getActiveAds();
    public function getAdForPosition($positionIdentifier);
    public function recordImpression($ad);
    public function recordClick($ad);
}