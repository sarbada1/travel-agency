<?php

namespace App\Repositories\Banner;

use App\Models\Banner\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BannerRepository implements BannerInterface
{
    public function getAllBanners()
    {
        return Banner::orderBy('sort_order')->get();
    }

    public function getBannersByPosition($position)
    {
        return Banner::where('position', $position)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }


    public function storeBanner($data)
    {
        $banner = new Banner();
        $banner->title = $data['title'] ?? null;
        $banner->description = $data['description'] ?? null;
        $banner->button_text = $data['button_text'] ?? null;
        $banner->button_url = $data['button_url'] ?? null;
        $banner->position = $data['position'] ?? 'home_hero';
        $banner->media_type = $data['media_type'] ?? 'image';
        $banner->is_active = isset($data['is_active']);
        $banner->sort_order = $data['sort_order'] ?? 0;

        // Handle media upload based on type
        if ($banner->media_type == 'image') {
            if (isset($data['image']) && $data['image']->isValid()) {
                $fileName = 'banner_' . time() . '.' . $data['image']->getClientOriginalExtension();
                $data['image']->move(public_path('uploads/banners'), $fileName);
                $banner->image = 'uploads/banners/' . $fileName;
            }
        } else if ($banner->media_type == 'video') {
            if (isset($data['video']) && $data['video']->isValid()) {
                $fileName = 'banner_video_' . time() . '.' . $data['video']->getClientOriginalExtension();
                $data['video']->move(public_path('uploads/banners/videos'), $fileName);
                $banner->video = 'uploads/banners/videos/' . $fileName;
            }
        }

        $banner->save();

        // Clear cache
        $this->clearCache();

        return $banner;
    }

    // Similarly update the updateBanner method
    public function updateBanner($data, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->title = $data['title'] ?? null;
        $banner->description = $data['description'] ?? null;
        $banner->button_text = $data['button_text'] ?? null;
        $banner->button_url = $data['button_url'] ?? null;
        $banner->position = $data['position'] ?? 'home_hero';
        $banner->media_type = $data['media_type'] ?? 'image';
        $banner->is_active = isset($data['is_active']);
        $banner->sort_order = $data['sort_order'] ?? 0;

        // Handle media upload based on type
        if ($banner->media_type == 'image') {
            if (isset($data['image']) && $data['image']->isValid()) {
                // Delete old image
                if ($banner->image && file_exists(public_path($banner->image))) {
                    unlink(public_path($banner->image));
                }

                $fileName = 'banner_' . time() . '.' . $data['image']->getClientOriginalExtension();
                $data['image']->move(public_path('uploads/banners'), $fileName);
                $banner->image = 'uploads/banners/' . $fileName;
            }
        } else if ($banner->media_type == 'video') {
            if (isset($data['video']) && $data['video']->isValid()) {
                // Delete old video
                if ($banner->video && file_exists(public_path($banner->video))) {
                    unlink(public_path($banner->video));
                }

                $fileName = 'banner_video_' . time() . '.' . $data['video']->getClientOriginalExtension();
                $data['video']->move(public_path('uploads/banners/videos'), $fileName);
                $banner->video = 'uploads/banners/videos/' . $fileName;
            }
        }

        $banner->save();

        // Clear cache
        $this->clearCache();

        return $banner;
    }

    // Update the deleteBanner method to handle video files
    public function deleteBanner($id)
    {
        $banner = Banner::findOrFail($id);

        // Delete media files
        if ($banner->media_type == 'image' && $banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        } else if ($banner->media_type == 'video' && $banner->video && file_exists(public_path($banner->video))) {
            unlink(public_path($banner->video));
        }

        $banner->delete();

        // Clear cache
        $this->clearCache();

        return true;
    }

    private function clearCache()
    {
        foreach (Banner::positions() as $key => $value) {
            Cache::forget('home_banner_slides');
            Cache::forget($key . '_banners');
        }
    }

    public function getBanner($id)
    {
        return Banner::findOrFail($id);
    }
}
