<?php

namespace App\Repositories\TourPackage;

use App\Traits\General;
use Illuminate\Support\Str;
use App\Models\TourPackage\TourPackage;
use App\Services\AttributeValueService;
use App\Models\TourPackage\AttributeValue;
use App\Models\TourPackage\PackageAttribute;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TourPackageRepository implements TourPackageInterface
{
    use General;

    protected $attributeValueService;
    private $model;

    public function __construct(TourPackage $model, AttributeValueService $attributeValueService = null)
    {
        $this->model = $model;
        $this->attributeValueService = $attributeValueService ?? new AttributeValueService();
    }

    public function getAll()
    {
        return $this->model->with(['categories'])->get();
    }

    public function getById($criteria)
    {
        return $this->model->with(['categories'])->findOrFail($criteria);
    }

    private function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {
            $attributeData = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = substr($key, strlen('attribute_'));
                    $attributeData[$attributeId] = $value;
                    unset($data[$key]); // Remove from main data array
                }
            }
            
            // Extract category, destination, and activity IDs
            $categories = $data['categories'] ?? null;
            unset($data['categories']);
            
            $destinations = $data['destinations'] ?? null;
            unset($data['destinations']);
            
            $activities = $data['activities'] ?? null;
            unset($data['activities']);
            
            // Add user ID if not provided
            if (!isset($data['user_id'])) {
                $data['user_id'] = auth()->id();
            }
            
            // Generate slug if not provided
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            
            // Handle featured image upload if provided
            if (isset($data['featured_image']) && $data['featured_image'] instanceof \Illuminate\Http\UploadedFile) {
                $tableName = $this->model->getTable();
                $filePath = 'uploads/' . $tableName . '/featured';
                $fileData['featured_image'] = $this->customFileUpload($filePath, 'featured_image');
                $data['featured_image'] = $fileData['featured_image'];
            }
            
            // Handle gallery images similarly if provided
            if (isset($data['gallery_images']) && is_array($data['gallery_images'])) {
                $galleryImages = [];
                $tableName = $this->model->getTable();
                $filePath = 'uploads/' . $tableName . '/gallery';
                
                foreach ($data['gallery_images'] as $index => $galleryImage) {
                    if ($galleryImage instanceof \Illuminate\Http\UploadedFile) {
                        $fieldName = 'gallery_images.' . $index;
                        $imagePath = $this->customFileUpload($filePath, $fieldName);
                        if ($imagePath) {
                            $galleryImages[] = $imagePath;
                        }
                    }
                }
                
                if (!empty($galleryImages)) {
                    $data['gallery_images'] = json_encode($galleryImages);
                }
            }
            
            // Create the tour package
            $tourPackage = $this->model->create($data);
            
            // Sync categories if provided
            if (is_array($categories)) {
                $tourPackage->categories()->sync($categories);
            }
            
            // Sync destinations if provided
            if (is_array($destinations)) {
                // Use a proper pivot table name based on your database structure
                $tourPackage->destinations()->sync($destinations);
            }
            
            // Sync activities if provided
            if (is_array($activities)) {
                $tourPackage->activities()->sync($activities);
            }
            
            // Save attribute values
            if (!empty($attributeData)) {
                $this->saveAttributeValues($tourPackage, $attributeData);
            }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to create tour package: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            throw $e;
        }
    }
    
    public function update(array $data, $id)
    {
        DB::beginTransaction();
        try {
            // Extract attribute data (all fields starting with 'attribute_')
            $attributeData = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = substr($key, strlen('attribute_'));
                    $attributeData[$attributeId] = $value;
                    unset($data[$key]); // Remove from main data array
                }
            }
            
            // Extract category, destination, and activity IDs
            $categories = $data['categories'] ?? null;
            unset($data['categories']);
            
            $destinations = $data['destinations'] ?? null;
            unset($data['destinations']);
            
            $activities = $data['activities'] ?? null;
            unset($data['activities']);
            
            $tourPackage = $this->getById($id);
            
            // Handle featured image upload if provided
            if (isset($data['featured_image']) && $data['featured_image'] instanceof \Illuminate\Http\UploadedFile) {
                $tableName = $this->model->getTable();
                $filePath = 'uploads/' . $tableName . '/featured';
                $fileData['featured_image'] = $this->customFileUpload($filePath, 'featured_image');
                $data['featured_image'] = $fileData['featured_image'];
            }
            if (isset($data['gallery_images']) && is_array($data['gallery_images'])) {
                $galleryImages = [];
                $tableName = $this->model->getTable();
                $filePath = 'uploads/' . $tableName . '/gallery';
                
                foreach ($data['gallery_images'] as $index => $galleryImage) {
                    if ($galleryImage instanceof \Illuminate\Http\UploadedFile) {
                        $fieldName = 'gallery_images.' . $index;
                        $imagePath = $this->customFileUpload($filePath, $fieldName);
                        if ($imagePath) {
                            $galleryImages[] = $imagePath;
                        }
                    }
                }
                
                if (!empty($galleryImages)) {
                    $data['gallery_images'] = json_encode($galleryImages);
                }
            } else {
                // If no new gallery images were uploaded, preserve existing ones
                unset($data['gallery_images']);
            }
            // Update the tour package
            $tourPackage->update($data);
            
            // Sync categories if provided
            if (is_array($categories)) {
                $tourPackage->categories()->sync($categories);
            }
            
            // Sync destinations if provided
            if (is_array($destinations)) {
                $tourPackage->destinations()->sync($destinations);
            }
            
            // Sync activities if provided
            if (is_array($activities)) {
                $tourPackage->activities()->sync($activities);
            }
            
            // Update attribute values
            if (!empty($attributeData)) {
                // First, remove all existing attribute values
                $tourPackage->attributeValues()->delete();
                
                // Then, add the new ones
                $this->saveAttributeValues($tourPackage, $attributeData);
            }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to update tour package: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    public function getWithAttributes($id)
    {
        // Load the tour package with its relationships
        $tourPackage = $this->model->with([
            'user', 
            'categories', 
            'destinations', 
            'attributeValues.packageAttribute.attributeGroup'
        ])->findOrFail($id);
        
        // Initialize attribute_groups as an empty array 
        $tourPackage->attribute_groups = [];
        
        // Group attribute values by their attribute groups
        if ($tourPackage->attributeValues->count() > 0) {
            $grouped = [];
            
            foreach ($tourPackage->attributeValues as $value) {
                if (!$value->packageAttribute || !$value->packageAttribute->attributeGroup) {
                    continue; // Skip if attribute or group is missing
                }
                
                $group = $value->packageAttribute->attributeGroup;
                $attribute = $value->packageAttribute;
                
                $groupSlug = \Str::slug($group->name);
                
                if (!isset($grouped[$groupSlug])) {
                    $grouped[$groupSlug] = [
                        'id' => $group->id,
                        'name' => $group->name,
                        'attributes' => []
                    ];
                }
                
                // Get value based on attribute type
                $attributeValue = $value->getValue();
                
                // Log to debug
                \Log::info("Loaded attribute: {$attribute->name} with value:", [
                    'id' => $attribute->id,
                    'type' => $attribute->type,
                    'value' => $attributeValue,
                    'value_type' => gettype($attributeValue)
                ]);
                
                // Add attribute to its group
                $grouped[$groupSlug]['attributes'][] = [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'type' => $attribute->type,
                    'value' => $attributeValue
                ];
            }
            
            $tourPackage->attribute_groups = $grouped;
        }
        
        return $tourPackage;
    }

    protected function getAttributeValue($attribute)
    {
        $type = $attribute->packageAttribute->type ?? 'text';

        switch ($type) {
            case 'text':
                return $attribute->text_value;
            case 'rich_text':
                return $attribute->rich_text_value;
            case 'array':
            case 'json':
                return $attribute->json_value ? json_decode($attribute->json_value, true) : null;
            case 'boolean':
                return (bool)$attribute->boolean_value;
            case 'number':
                return $attribute->numeric_value;
            default:
                return $attribute->text_value;
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

        // Delete attribute values
        AttributeValue::where('attributable_id', $tourPackage->id)
            ->where('attributable_type', get_class($tourPackage))
            ->delete();

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

    private function saveAttributeValues($tourPackage, $attributeData)
    {
        foreach ($attributeData as $attributeId => $value) {
            $attribute = PackageAttribute::find($attributeId);
            if (!$attribute) {
                continue;
            }
    
            $valueColumn = $this->getValueColumnForType($attribute->type);
    
            // Process value based on type
            $processedValue = $value;
            if ($attribute->type === 'array' || $attribute->type === 'json') {
                // For array/json types, ensure we always store valid JSON
                if (is_array($value)) {
                    // If it's already an array, encode it
                    $processedValue = json_encode($value);
                } else if (is_string($value) && !empty($value)) {
                    // If it's a non-empty string, treat it as a single array item
                    $processedValue = json_encode([$value]);
                } else if (empty($value)) {
                    // If empty, store as empty array
                    $processedValue = json_encode([]);
                } else {
                    // For any other value, wrap it in an array
                    $processedValue = json_encode([$value]);
                }
            } elseif ($attribute->type === 'boolean') {
                $processedValue = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }
    
            // Debug the processed value before saving
            Log::info("Saving attribute #{$attributeId} ({$attribute->name}) of type {$attribute->type}", [
                'original_value' => $value,
                'processed_value' => $processedValue,
                'column' => $valueColumn
            ]);
    
            // Create attribute value
            AttributeValue::create([
                'package_attribute_id' => $attributeId,
                'attributable_id' => $tourPackage->id,
                'attributable_type' => get_class($tourPackage),
                $valueColumn => $processedValue
            ]);
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
            case 'json':
                return 'json_value';
            case 'boolean':
                return 'boolean_value';
            case 'number':
                return 'numeric_value'; // Changed from 'number_value' to 'numeric_value'
            case 'date':
                return 'date_value';
            default:
                return 'text_value';
        }
    }
}
