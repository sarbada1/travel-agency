<?php

namespace App\Repositories\Ad;

use App\Models\Ad\Campaign;
use App\Models\Ad\CampaignMetric;

class CampaignRepository implements CampaignInterface
{
    protected $campaign;
    protected $campaignMetric;

    public function __construct(Campaign $campaign, CampaignMetric $campaignMetric)
    {
        $this->campaign = $campaign;
        $this->campaignMetric = $campaignMetric;
    }

    /**
     * Get all campaigns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->campaign->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get campaign by ID
     *
     * @param int $id
     * @return \App\Models\Campaign|null
     */
    public function getById($id)
    {
        return $this->campaign->findOrFail($id);
    }

    /**
     * Insert new campaign
     *
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        return (bool) $this->campaign->create($data);
    }

    /**
     * Update campaign
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update($data, $id)
    {
        $campaign = $this->campaign->findOrFail($id);
        return $campaign->update($data);
    }

    /**
     * Delete campaign
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $campaign = $this->campaign->findOrFail($id);
        return $campaign->delete();
    }

    /**
     * Get campaign metrics
     *
     * @param int $campaignId
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getMetrics($campaignId, $startDate = null, $endDate = null)
    {
        $query = $this->campaignMetric->where('campaign_id', $campaignId);
        
        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }
        
        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }
        
        return $query->orderBy('date')->get();
    }
}