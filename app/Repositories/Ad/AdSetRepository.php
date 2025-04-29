<?php

namespace App\Repositories\Ad;

use App\Models\Ad\AdSet;
use App\Traits\General;

class AdSetRepository implements AdSetInterface
{
    use General;

    protected $adSet;

    public function __construct(AdSet $adSet)
    {
        $this->adSet = $adSet;
    }

    /**
     * Get all ad sets
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->adSet->with('campaign')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get ad set by ID
     *
     * @param int $id
     * @return \App\Models\Ad\AdSet|null
     */
    public function getById($id)
    {
        return $this->adSet->with(['campaign', 'ads'])->findOrFail($id);
    }

    /**
     * Get ad sets by campaign ID
     *
     * @param int $campaignId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByCampaignId($campaignId)
    {
        return $this->adSet->where('campaign_id', $campaignId)->get();
    }

    /**
     * Insert new ad set
     *
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        try {
            // Convert targeting_specs to JSON if it's an array
            if (isset($data['targeting_specs']) && is_array($data['targeting_specs'])) {
                $data['targeting_specs'] = json_encode($data['targeting_specs']);
            }
            
            // Create the ad set
            $adSet = $this->adSet->create($data);
            
            return $adSet->id;
        } catch (\Exception $e) {
            \Log::error('Error creating ad set: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update ad set
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update($data, $id)
    {
        try {
            $adSet = $this->getById($id);
            
            // Convert targeting_specs to JSON if it's an array
            if (isset($data['targeting_specs']) && is_array($data['targeting_specs'])) {
                $data['targeting_specs'] = json_encode($data['targeting_specs']);
            }
            
            return $adSet->update($data);
        } catch (\Exception $e) {
            \Log::error('Error updating ad set: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete ad set
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            $adSet = $this->getById($id);
            return $adSet->delete();
        } catch (\Exception $e) {
            \Log::error('Error deleting ad set: ' . $e->getMessage());
            return false;
        }
    }
}