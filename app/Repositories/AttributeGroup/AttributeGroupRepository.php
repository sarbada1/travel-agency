<?php

namespace App\Repositories\AttributeGroup;

use App\Models\TourPackage\AttributeGroup;
use App\Traits\General;

class AttributeGroupRepository implements AttributeGroupInterface
{
    use General;

    private $model;

    public function __construct(AttributeGroup $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('display_order')->get();
    }

    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }

    public function insert(array $data)
    {
        try {
            $data['user_id'] = auth()->user()->id ?? 1;
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
        if ($this->model->findOrFail($id)->update($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        // Check if this group has attributes
        if ($this->model->findOrFail($id)->attributes()->count() > 0) {
            return false;
        }

        if ($this->model->findOrFail($id)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function getActiveGroups()
    {
        return $this->model->where('active', true)
            ->orderBy('display_order')
            ->get();
    }
}
