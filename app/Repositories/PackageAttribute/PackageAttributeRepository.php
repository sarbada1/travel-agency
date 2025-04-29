<?php

namespace App\Repositories\PackageAttribute;

use App\Models\TourPackage\PackageAttribute;
use App\Traits\General;

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

    public function insert(array $data)
    {
        try {
            // Convert array options to JSON if present
            if (isset($data['options']) && is_array($data['options'])) {
                $data['options'] = json_encode($data['options']);
            }
            
            if ($this->model->create($data)) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
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