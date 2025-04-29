<?php

namespace App\Repositories\Permission;

use App\Models\Permission\Permission;

class PermissionRepository implements PermissionInterface
{
    private Permission $_model;

    public function __construct(Permission $permission)
    {
        $this->_model = $permission;
    }


    public function all()
    {
        return Permission::all()->groupBy('table_name');

    }


    public function store($data): bool
    {
        $this->_model->name = $data['name'];
        if ($this->_model->save()) {
            return true;
        } else {
            return false;
        }
    }


    public function show($id)
    {
        return $this->_model->find($id);
    }


    public function update($data, $id): bool
    {
        $this->_model = $this->_model->find($id);
        $this->_model->name = $data['name'];
        if ($this->_model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id): bool
    {

        try {
            $this->_model = $this->_model->findOrFail($id);
            $this->_model->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }


    }

}
