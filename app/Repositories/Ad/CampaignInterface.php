<?php

namespace App\Repositories\Ad;

interface CampaignInterface
{
    /**
     * Get all campaigns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get campaign by ID
     *
     * @param int $id
     * @return \App\Models\Campaign|null
     */
    public function getById($id);

    /**
     * Insert new campaign
     *
     * @param array $data
     * @return bool
     */
    public function insert($data);

    /**
     * Update campaign
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update($data, $id);

    /**
     * Delete campaign
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);

    /**
     * Get campaign metrics
     *
     * @param int $campaignId
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getMetrics($campaignId, $startDate = null, $endDate = null);
}