<?php

namespace App\Repositories\TourPackage;

use App\Models\TourPackage\TourPackage;
use App\Models\TourPackage\AttributeValue;
use App\Traits\General;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class TourPackageRepository implements TourPackageInterface
{
    use General;

    private $model;

    public function __construct(TourPackage $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with(['categories', 'destinations'])->get();
    }

    public function getById($criteria)
    {
        return $this->model->with(['categories', 'destinations', 'activities'])->findOrFail($criteria);
    }

    private function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function insert(array $data)
    {
        try {
            // Set user ID
            $data['user_id'] = auth()->user()->id ?? 1;
            
            // Generate slug if not provided
            if (!isset($data['slug']) || empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            
            // Handle gallery images
            if (isset($data['gallery_images']) && is_array($data['gallery_images'])) {
                $data['gallery_images'] = json_encode($data['gallery_images']);
            }
            
            // Extract attribute data
            $attributeData = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = substr($key, 10); // Extract ID after 'attribute_'
                    $attributeData[$attributeId] = $value;
                    unset($data[$key]);
                }
            }
            
            // Create tour package
            $tourPackage = $this->model->create($data);
            
            if ($tourPackage) {
                // Handle featured image upload
                $tableName = $this->model->getTable();
                $filePath = 'uploads/' . $tableName;
                $fileData['featured_image'] = $this->customFileUpload($filePath);
                $this->updateFile($tourPackage->id, $fileData);
                
                // Handle categories
                if (isset($data['categories']) && is_array($data['categories'])) {
                    $tourPackage->categories()->sync($data['categories']);
                }
                
                // Handle destinations
                if (isset($data['destinations']) && is_array($data['destinations'])) {
                    $tourPackage->destinations()->sync($data['destinations']);
                }
                
                // Handle activities
                if (isset($data['activities']) && is_array($data['activities'])) {
                    $activities = [];
                    foreach ($data['activities'] as $activityId) {
                        $isOptional = isset($data['activity_optional'][$activityId]) ? true : false;
                        $additionalCost = isset($data['activity_cost'][$activityId]) ? $data['activity_cost'][$activityId] : 0;
                        
                        $activities[$activityId] = [
                            'is_optional' => $isOptional,
                            'additional_cost' => $additionalCost
                        ];
                    }
                    $tourPackage->activities()->sync($activities);
                }
                
                // Save attribute values
                $this->saveAttributeValues($tourPackage, $attributeData);
                
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    public function update(array $data, $id)
    {
        try {
            $tourPackage = $this->model->findOrFail($id);
            
            // Generate slug if not provided
            if (!isset($data['slug']) || empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            
            // Handle gallery images
            if (isset($data['gallery_images']) && is_array($data['gallery_images'])) {
                $data['gallery_images'] = json_encode($data['gallery_images']);
            }
            
            // Extract attribute data
            $attributeData = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = substr($key, 10); // Extract ID after 'attribute_'
                    $attributeData[$attributeId] = $value;
                    unset($data[$key]);
                }
            }
            
            // Update tour package
            if ($tourPackage->update($data)) {
                // Handle categories
                if (isset($data['categories']) && is_array($data['categories'])) {
                    $tourPackage->categories()->sync($data['categories']);
                }
                
                // Handle destinations
                if (isset($data['destinations']) && is_array($data['destinations'])) {
                    $tourPackage->destinations()->sync($data['destinations']);
                }
                
                // Handle activities
                if (isset($data['activities']) && is_array($data['activities'])) {
                    $activities = [];
                    foreach ($data['activities'] as $activityId) {
                        $isOptional = isset($data['activity_optional'][$activityId]) ? true : false;
                        $additionalCost = isset($data['activity_cost'][$activityId]) ? $data['activity_cost'][$activityId] : 0;
                        
                        $activities[$activityId] = [
                            'is_optional' => $isOptional,
                            'additional_cost' => $additionalCost
                        ];
                    }
                    $tourPackage->activities()->sync($activities);
                }
                
                // Save attribute values
                $this->saveAttributeValues($tourPackage, $attributeData);
                
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $http_s = "";
        if (Request::isSecure()) {
            $http_s .= 'https:';
        } else {
            $http_s .= 'http:';
        }

        $tourPackage = $this->model->findOrFail($id);
        
        // Delete featured image
        if ($tourPackage->featured_image) {
            $imagePath = parse_url($tourPackage->featured_image, PHP_URL_PATH);
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }
        
        // Delete gallery images
        if ($tourPackage->gallery_images) {
            $galleryImages = json_decode($tourPackage->gallery_images, true);
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $image) {
                    $imagePath = parse_url($image, PHP_URL_PATH);
                    if (file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    }
                }
            }
        }
        
        // Delete description images
        $descriptionImages = [];
        preg_match_all('/<img[^>]+src="([^">]+)"/', $tourPackage->description, $matches);
        if (isset($matches[1])) {
            $descriptionImages = $matches[1];
        }
        
        foreach ($descriptionImages as $image) {
            if (strpos($image, $http_s) === 0) {
                $imagePath = parse_url($image, PHP_URL_PATH);
                if (file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
            }
        }

        if ($tourPackage->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFeatured()
    {
        return $this->model->where('is_featured', true)
                            ->where('status', 'active')
                            ->with(['categories', 'destinations'])
                            ->get();
    }

    public function getPopular()
    {
        return $this->model->where('is_popular', true)
                            ->where('status', 'active')
                            ->with(['categories', 'destinations'])
                            ->get();
    }

    public function getByCategoryId($categoryId)
    {
        return $this->model->whereHas('categories', function ($query) use ($categoryId) {
                                $query->where('categories.id', $categoryId);
                            })
                            ->where('status', 'active')
                            ->with(['categories', 'destinations'])
                            ->get();
    }

    public function getByDestinationId($destinationId)
    {
        return $this->model->whereHas('destinations', function ($query) use ($destinationId) {
                                $query->where('destinations.id', $destinationId);
                            })
                            ->where('status', 'active')
                            ->with(['categories', 'destinations'])
                            ->get();
    }

    public function getWithAttributes($packageId)
    {
        $package = $this->model->with(['categories', 'destinations', 'activities'])->findOrFail($packageId);
        $attributes = AttributeValue::with('packageAttribute')
                                    ->where('attributable_id', $packageId)
                                    ->where('attributable_type', get_class($this->model))
                                    ->get();
                                    
        $package->attributeValues = $attributes;
        return $package;
    }
    
    private function saveAttributeValues($tourPackage, $attributeData)
    {
        foreach ($attributeData as $attributeId => $value) {
            $attribute = \App\Models\TourPackage\PackageAttribute::find($attributeId);
            if (!$attribute) {
                continue;
            }
            
            $valueColumn = $this->getValueColumnForType($attribute->type);
            
            // Process value based on type
            $processedValue = $value;
            if ($attribute->type === 'array' && is_array($value)) {
                $processedValue = json_encode($value);
            } elseif ($attribute->type === 'json' && is_array($value)) {
                $processedValue = json_encode($value);
            } elseif ($attribute->type === 'boolean') {
                $processedValue = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }
            
            // Create or update attribute value
            AttributeValue::updateOrCreate(
                [
                    'package_attribute_id' => $attributeId,
                    'attributable_id' => $tourPackage->id,
                    'attributable_type' => get_class($tourPackage),
                ],
                [
                    $valueColumn => $processedValue
                ]
            );
        }
    }
    
    protected function getValueColumnForType($type)
    {
        switch ($type) {
            case 'text':
                return 'text_value';
            case 'rich_text':
                return 'rich_text_value';
            case 'array':
                return 'array_value';
            case 'json':
                return 'json_value';
            case 'boolean':
                return 'boolean_value';
            case 'number':
                return 'number_value';
            case 'date':
                return 'date_value';
            default:
                return 'text_value';
        }
    }
}