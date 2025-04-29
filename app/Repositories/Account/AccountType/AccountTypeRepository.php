<?php

namespace App\Repositories\Account\AccountType;

use App\Models\User\AccountType;

class AccountTypeRepository implements AccountTypeInterface
{

    private $model;

    public function __construct(AccountType $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

}
