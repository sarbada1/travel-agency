<?php

namespace App\Repositories\Ad;

use App\Models\Ad\AdPlacement;
use Illuminate\Support\Facades\Cache;

class AdPlacementRepository implements AdPlacementInterface
{
    protected $adPlacement;

    public function __construct(AdPlacement $adPlacement)
    {
        $this->adPlacement = $adPlacement;
    }

    public function all()
    {
        return $this->adPlacement->with(['ad', 'position'])->get();
    }

    public function getById($id)
    {
        return $this->adPlacement->findOrFail($id);
    }

    public function insert($data)
    {
        $result = $this->adPlacement->create($data);
        
        // Clear cache for this position
        $position = $result->position;
        if ($position) {
            Cache::forget("ad_for_position_{$position->identifier}");
        }
        
        return $result;
    }

    public function update($data, $id)
    {
        $placement = $this->getById($id);
        
        // Get old position for cache clearing
        $oldPosition = $placement->position;
        
        $result = $placement->update($data);
        
        // Clear cache for both old and new positions if different
        if ($oldPosition) {
            Cache::forget("ad_for_position_{$oldPosition->identifier}");
        }
        
        $newPosition = $placement->fresh()->position;
        if ($newPosition && (!$oldPosition || $oldPosition->id !== $newPosition->id)) {
            Cache::forget("ad_for_position_{$newPosition->identifier}");
        }
        
        return $result;
    }

    public function delete($id)
    {
        $placement = $this->getById($id);
        
        // Clear cache for this position
        $position = $placement->position;
        if ($position) {
            Cache::forget("ad_for_position_{$position->identifier}");
        }
        
        return $placement->delete();
    }

    public function getByAdId($adId)
    {
        return $this->adPlacement->where('ad_id', $adId)->with('position')->get();
    }

    public function getByPositionId($positionId)
    {
        return $this->adPlacement->where('position_id', $positionId)->with('ad')->get();
    }
}