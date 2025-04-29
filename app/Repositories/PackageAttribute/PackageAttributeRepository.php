<?php

namespace App\Repositories\PackageAttribute;

use Log;
use App\Traits\General;
use App\Models\TourPackage\PackageAttribute;

class PackageAttributeRepository implements PackageAttributeInterface
{
    use General;

    private $model;

    public function __construct(PackageAttribute $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('attributeGroup')
                            ->orderBy('display_order')
                            ->get();
    }

    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }
    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }


    public function insert(array $data)
    {
        try {
            Log::info('PackageAttribute insert data', ['data' => $data]);
            
            if (isset($data['options']) && is_array($data['options'])) {
                $data['options'] = array_filter($data['options']);
                
                if (!empty($data['options'])) {
                    $data['options'] = json_encode($data['options']);
                } else {
                    $data['options'] = null; 
                }
            }
            
            $result = $this->model->create($data);
            
            Log::info('PackageAttribute created successfully', ['id' => $result->id]);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to create PackageAttribute: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return false;
        }
    }

    public function update(array $data, $id)
    {
        // Convert array options to JSON if present
        if (isset($data['options']) && is_array($data['options'])) {
            $data['options'] = json_encode($data['options']);
        }
        
        if ($this->model->findOrFail($id)->update($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        // Check if this attribute has values
        if ($this->model->findOrFail($id)->attributeValues()->count() > 0) {
            return false;
        }

        if ($this->model->findOrFail($id)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function getByGroup($groupId)
    {
        return $this->model->where('attribute_group_id', $groupId)
                            ->where('active', true)
                            ->orderBy('display_order')
                            ->get();
    }

    public function getFilterableAttributes()
    {
        return $this->model->where('is_filterable', true)
                            ->where('active', true)
                            ->orderBy('display_order')
                            ->get();
    }
}