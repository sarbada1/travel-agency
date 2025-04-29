<?php

namespace App\Repositories\Ad;

use Log;
use App\Models\Ad\Ad;
use App\Traits\General;

use App\Models\Ad\AdPosition;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AdRepository implements AdInterface
{
    use General;

    protected $ad;
    protected $adPosition;

    public function __construct(Ad $ad, AdPosition $adPosition)
    {
        $this->ad = $ad;
        $this->adPosition = $adPosition;
    }

    public function all()
    {
        return $this->ad->latest()->get();
    }

    public function getById($id)
    {
        return $this->ad->findOrFail($id);
    }

    private function updateFile($id, $data)
    {
        return $this->ad->findOrFail($id)->update($data);

    }

    public function insert($data)
    {
        try {
            // Check if we have an image file to upload
            $imageFile = null;
            if (isset($data['image']) && $data['image']) {
                $imageFile = $data['image'];
                // Remove image from data array to prevent errors when creating record
                unset($data['image']);
            }
            
            // Create the ad
            $ad = $this->ad->create($data);
            
            if ($ad && $imageFile) {
                // Process the image upload
                $tableName = $this->ad->getTable();
                $filePath = 'uploads/' . $tableName;
                
                // Create directory if it doesn't exist
                $fullPath = public_path($filePath);
                if (!file_exists($fullPath)) {
                    mkdir($fullPath, 0755, true);
                }
                
                // Generate a unique filename
                $fileName = time() . '_' . $imageFile->getClientOriginalName();
                
                // Move the uploaded file
                $imageFile->move($fullPath, $fileName);
                
                // Update the ad with the image path
                $fileData = [
                    'image_path' => $filePath . '/' . $fileName
                ];
                
                $this->updateFile($ad->id, $fileData);
            }
            
            return $ad->id;
        } catch (\Exception $e) {
            Log::error('Error creating ad: ' . $e->getMessage());
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            $ad = $this->getById($id);
            
            // Handle image upload if present
            if (isset($data['image']) && $data['image']) {
                // Delete old image if exists
                if ($ad->image_path && file_exists(public_path($ad->image_path))) {
                    unlink(public_path($ad->image_path));
                }
                
                // Process the new image
                $tableName = $this->ad->getTable();
                $filePath = 'uploads/' . $tableName;
                
                // Create directory if it doesn't exist
                $fullPath = public_path($filePath);
                if (!file_exists($fullPath)) {
                    mkdir($fullPath, 0755, true);
                }
                
                // Generate a unique filename
                $fileName = time() . '_' . $data['image']->getClientOriginalName();
                
                // Move the uploaded file
                $data['image']->move($fullPath, $fileName);
                
                // Set the new image path
                $data['image_path'] = $filePath . '/' . $fileName;
                
                // Remove the image file from data to prevent errors
                unset($data['image']);
            }
            
            return $ad->update($data);
        } catch (\Exception $e) {
            Log::error('Error updating ad: ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        $ad = $this->getById($id);
        
        // Delete the image if exists
        if ($ad->image_path && file_exists(public_path($ad->image_path))) {
            unlink(public_path($ad->image_path));
        }
        
        return $ad->delete();
    }

    public function getActiveAds()
    {
        $today = now()->startOfDay();
        
        return $this->ad->where('is_active', true)
            ->where(function ($query) use ($today) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', $today);
            })
            ->where(function ($query) use ($today) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            })
            ->get();
    }

    public function getAdForPosition($positionIdentifier)
    {
        // Try to get from cache first (10 minutes cache)
        return Cache::remember("ad_for_position_{$positionIdentifier}", 600, function () use ($positionIdentifier) {
            $position = $this->adPosition->where('identifier', $positionIdentifier)->first();
            
            if (!$position) {
                return null;
            }
            
            // Get active ads for this position, ordered by priority
            $ad = $position->ads()
                ->where('is_active', true)
                ->where(function ($query) {
                    $today = now()->startOfDay();
                    $query->whereNull('start_date')
                        ->orWhere('start_date', '<=', $today);
                })
                ->where(function ($query) {
                    $today = now()->startOfDay();
                    $query->whereNull('end_date')
                        ->orWhere('end_date', '>=', $today);
                })
                ->orderBy('ad_placements.priority')
                ->first();
                
            return $ad;
        });
    }

    public function recordImpression($ad)
    {
        if ($ad instanceof Ad) {
            $ad->increment('impressions');
            return true;
        }
        
        return false;
    }

    public function recordClick($ad)
    {
        if ($ad instanceof Ad) {
            $ad->increment('clicks');
            return true;
        }
        
        return false;
    }
}