<?php

namespace App\Repositories\TourPackage;

use App\Traits\General;
use Illuminate\Support\Str;
use App\Models\TourPackage\TourPackage;
use App\Services\AttributeValueService;
use Illuminate\Support\Facades\Request;
use App\Models\TourPackage\AttributeValue;

class TourPackageRepository implements TourPackageInterface
{
    use General;
    protected $attributeValueService;

    private $model;

    public function __construct(TourPackage $model, AttributeValueService $attributeValueService)
    {
        $this->model = $model;
        $this->attributeValueService = $attributeValueService;
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
            DB::beginTransaction();

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

            // Create the tour package
            $tourPackage = $this->model->create($data);

            // Attach categories, destinations, and activities
            if (!empty($categories)) {
                $tourPackage->categories()->attach($categories);
            }

            if (!empty($destinations)) {
                $tourPackage->categories()->attach($destinations); // Destinations are stored in categories
            }

            // Save itinerary data
            if (!empty($itinerary)) {
                $this->attributeValueService->saveItinerary($tourPackage->id, $itinerary);
            }

            // Save inclusions
            if (!empty($inclusions)) {
                $this->attributeValueService->saveInclusions($tourPackage->id, $inclusions);
            }

            // Save exclusions
            if (!empty($exclusions)) {
                $this->attributeValueService->saveExclusions($tourPackage->id, $exclusions);
            }

            // Save all dynamic attributes
            foreach ($attributeValues as $attributeId => $value) {
                $this->attributeValueService->saveAttributeValue(
                    $tourPackage->id,
                    $attributeId,
                    $value
                );
            }

            DB::commit();
            return $tourPackage;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create tour package: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return false;
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

            // Delete existing attributes and save new values
            AttributeValue::where('tour_package_id', $tourPackage->id)->delete();

            // Save itinerary data
            if (!empty($itinerary)) {
                $this->attributeValueService->saveItinerary($tourPackage->id, $itinerary);
            }

            // Save inclusions
            if (!empty($inclusions)) {
                $this->attributeValueService->saveInclusions($tourPackage->id, $inclusions);
            }

            // Save exclusions
            if (!empty($exclusions)) {
                $this->attributeValueService->saveExclusions($tourPackage->id, $exclusions);
            }

            // Save all dynamic attributes
            foreach ($attributeValues as $attributeId => $value) {
                $this->attributeValueService->saveAttributeValue(
                    $tourPackage->id,
                    $attributeId,
                    $value
                );
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update tour package: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return false;
        }
    }

    public function getWithAttributes($id)
    {
        $tourPackage = $this->model->with(['categories', 'user'])->findOrFail($id);

        // Get all attributes for this package, grouped by attribute group
        $tourPackage->attribute_groups = $this->attributeValueService->getGroupedAttributes($id);

        return $tourPackage;
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
