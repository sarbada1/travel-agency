<?php

namespace App\Repositories\Ad;

use App\Models\Ad\AdPosition;

class AdPositionRepository implements AdPositionInterface
{
    protected $adPosition;

    public function __construct(AdPosition $adPosition)
    {
        $this->adPosition = $adPosition;
    }

    public function all()
    {
        return $this->adPosition->all();
    }

    public function getById($id)
    {
        return $this->adPosition->findOrFail($id);
    }

    public function insert($data)
    {
        return $this->adPosition->create($data);
    }

    public function update($data, $id)
    {
        $position = $this->getById($id);
        return $position->update($data);
    }

    public function delete($id)
    {
        return $this->adPosition->destroy($id);
    }
}