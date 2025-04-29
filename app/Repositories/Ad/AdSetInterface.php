<?php

namespace App\Repositories\Ad;

interface AdSetInterface
{
    /**
     * Get all ad sets
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get ad set by ID
     *
     * @param int $id
     * @return \App\Models\Ad\AdSet|null
     */
    public function getById($id);

    /**
     * Get ad sets by campaign ID
     *
     * @param int $campaignId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByCampaignId($campaignId);

    /**
     * Insert new ad set
     *
     * @param array $data
     * @return bool
     */
    public function insert($data);

    /**
     * Update ad set
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update($data, $id);

    /**
     * Delete ad set
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}