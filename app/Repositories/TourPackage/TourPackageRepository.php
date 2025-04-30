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
        try {
            DB::beginTransaction();
    
            // Extract category, destination, and activity IDs
            $categories = $data['categories'] ?? [];
            unset($data['categories']);
    
            $destinations = $data['destinations'] ?? [];
            unset($data['destinations']);
    
            $activities = $data['activities'] ?? [];
            unset($data['activities']);
    
            // Extract all dynamic attributes
            $attributeValues = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = substr($key, strlen('attribute_'));
                    $attributeValues[$attributeId] = $value;
                    unset($data[$key]);
                }
            }
    
            // Log what we're about to save
            Log::info('About to create tour package with data:', [
                'data' => array_keys($data),
                'categories' => count($categories),
                'destinations' => count($destinations),
                'attributeValues' => count($attributeValues)
            ]);
    
            // Set default values for critical fields if missing
            if (empty($data['slug']) && !empty($data['name'])) {
                $data['slug'] = Str::slug($data['name']);
            }
            
            if (empty($data['duration_days'])) {
                $data['duration_days'] = 1;
            }
            
            if (empty($data['regular_price'])) {
                $data['regular_price'] = 0;
            }
    
            // Create the tour package
            $tourPackage = $this->model->create($data);
            Log::info('Tour package created with ID: ' . $tourPackage->id);
    
            // Attach categories if any
            if (!empty($categories)) {
                $tourPackage->categories()->attach($categories);
                Log::info('Categories attached: ' . implode(', ', $categories));
            }
    
            // Attach destinations if any
            if (!empty($destinations)) {
                $tourPackage->categories()->attach($destinations);
                Log::info('Destinations attached: ' . implode(', ', $destinations));
            }
    
            // Save attribute values if any
            if (!empty($attributeValues)) {
                $this->saveAttributeValues($tourPackage, $attributeValues);
                Log::info('Attribute values saved: ' . count($attributeValues));
            }
    
            DB::commit();
            return $tourPackage;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create tour package: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e; // Re-throw for the controller to handle
        }
    }

    public function update(array $data, $id)
    {
        try {
            DB::beginTransaction();

            $tourPackage = $this->getById($id);

            // Extract category, destination, and activity IDs
            $categories = $data['categories'] ?? [];
            unset($data['categories']);

            $destinations = $data['destinations'] ?? [];
            unset($data['destinations']);

            $activities = $data['activities'] ?? [];
            unset($data['activities']);

            // Extract itinerary data
            $itinerary = $data['itinerary'] ?? [];
            unset($data['itinerary']);

            // Extract inclusions and exclusions
            $inclusions = $data['inclusions'] ?? [];
            unset($data['inclusions']);

            $exclusions = $data['exclusions'] ?? [];
            unset($data['exclusions']);

            // Extract all dynamic attributes
            $attributeValues = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = substr($key, strlen('attribute_'));
                    $attributeValues[$attributeId] = $value;
                    unset($data[$key]);
                }
            }

            // Update the tour package
            $tourPackage->update($data);

            // Sync categories and destinations
            if (!empty($categories)) {
                $tourPackage->categories()->sync($categories);
            }

            if (!empty($destinations)) {
                // First detach all destinations
                $tourPackage->categories()->detach(
                    $tourPackage->destinations->pluck('id')->toArray()
                );

                // Then attach new destinations
                $tourPackage->categories()->attach($destinations);
            }

            // Delete existing attribute values
            AttributeValue::where('attributable_id', $tourPackage->id)
                ->where('attributable_type', get_class($tourPackage))
                ->delete();

            // Save all dynamic attributes
            $this->saveAttributeValues($tourPackage, $attributeValues);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update tour package: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e; // Re-throw to see the error during development
            return false;
        }
    }

    public function getWithAttributes($id)
    {
        $tourPackage = $this->model->with(['categories', 'user'])->findOrFail($id);

        // Get all attributes for this package
        $attributes = AttributeValue::where('attributable_id', $tourPackage->id)
            ->where('attributable_type', get_class($tourPackage))
            ->with(['packageAttribute', 'packageAttribute.attributeGroup'])
            ->get();
        
        // Group attributes by group
        $grouped = [];
        foreach ($attributes as $attribute) {
            $groupName = $attribute->packageAttribute->attributeGroup->name ?? 'Other';
            $groupSlug = $attribute->packageAttribute->attributeGroup->slug ?? 'other';
            
            if (!isset($grouped[$groupSlug])) {
                $grouped[$groupSlug] = [
                    'name' => $groupName,
                    'attributes' => []
                ];
            }
            
            $grouped[$groupSlug]['attributes'][] = [
                'id' => $attribute->packageAttribute->id,
                'name' => $attribute->packageAttribute->name,
                'slug' => $attribute->packageAttribute->slug,
                'type' => $attribute->packageAttribute->type,
                'value' => $this->getAttributeValue($attribute)
            ];
        }
        
        $tourPackage->attribute_groups = $grouped;
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
            if (($attribute->type === 'array' || $attribute->type === 'json') && is_array($value)) {
                $processedValue = json_encode($value);
            } elseif ($attribute->type === 'boolean') {
                $processedValue = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }

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