<?php

namespace App\Repositories\Banner;

use App\Models\Banner;

interface BannerInterface
{
    public function getAllBanners();
    public function getBannersByPosition($position);
    public function storeBanner($data);
    public function updateBanner($data, $id);
    public function deleteBanner($id);
    public function getBanner($id);

}