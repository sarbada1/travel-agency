<?php

namespace App\Repositories\MemberType;

use App\Models\MemberType\MemberType;

class MemberTypeRepository implements MemberTypeInterface
{

    private $_model;

    public function __construct(MemberType $permission)
    {
        $this->_model = $permission;
    }


    public function all()
    {

        return $this->_model->all();
    }


    public function store($data): bool
    {
        $this->_model->type = $data['type'];
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
        $this->_model->type = $data['type'];
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
