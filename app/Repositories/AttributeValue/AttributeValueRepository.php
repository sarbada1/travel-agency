<?php

namespace App\Repositories\AttributeValue;

use App\Models\TourPackage\AttributeValue;
use App\Models\TourPackage\PackageAttribute;
use App\Traits\General;

class AttributeValueRepository implements AttributeValueInterface
{
    use General;

    private $model;
    private $attributeModel;

    public function __construct(AttributeValue $model, PackageAttribute $attributeModel)
    {
        $this->model = $model;
        $this->attributeModel = $attributeModel;
    }

    public function getAll()
    {
        return $this->model->with('packageAttribute')->get();
    }

    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }

    public function insert(array $data)
    {
        try {
            $attribute = $this->attributeModel->findOrFail($data['package_attribute_id']);
            $valueColumn = $this->getValueColumnForType($attribute->type);

            // Process the value based on type
            if ($attribute->type === 'array' && is_array($data['value'])) {
                $data[$valueColumn] = json_encode($data['value']);
            } elseif ($attribute->type === 'json' && is_array($data['value'])) {
                $data[$valueColumn] = json_encode($data['value']);
            } else {
                $data[$valueColumn] = $data['value'];
            }

            unset($data['value']); // Remove the generic value field

            // Create or update the attribute value
            $this->model->updateOrCreate(
                [
                    'package_attribute_id' => $data['package_attribute_id'],
                    'attributable_id' => $data['attributable_id'],
                    'attributable_type' => $data['attributable_type'],
                ],
                $data
            );

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update(array $data, $id)
    {
        try {
            $attributeValue = $this->model->findOrFail($id);
            $attribute = $attributeValue->packageAttribute;
            $valueColumn = $this->getValueColumnForType($attribute->type);

            // Process the value based on type
            if ($attribute->type === 'array' && is_array($data['value'])) {
                $data[$valueColumn] = json_encode($data['value']);
            } elseif ($attribute->type === 'json' && is_array($data['value'])) {
                $data[$valueColumn] = json_encode($data['value']);
            } else {
                $data[$valueColumn] = $data['value'];
            }

            unset($data['value']); // Remove the generic value field

            if ($attributeValue->update($data)) {
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
        if ($this->model->findOrFail($id)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function getByAttributeAndEntity($attributeId, $entityId, $entityType)
    {
        return $this->model->where('package_attribute_id', $attributeId)
            ->where('attributable_id', $entityId)
            ->where('attributable_type', $entityType)
            ->first();
    }

    public function getForEntity($entityId, $entityType)
    {
        return $this->model->with('packageAttribute')
            ->where('attributable_id', $entityId)
            ->where('attributable_type', $entityType)
            ->get();
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
