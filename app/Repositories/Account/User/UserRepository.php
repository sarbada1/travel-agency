<?php

namespace App\Repositories\Account\User;

use App\Models\User\AccountType;
use App\Models\User\User;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;

    }

    public function get()
    {
        try {
            $authId = auth()->user()->id;
            return $this->model->where('id', '!=', $authId)
                ->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getById($id)
    {
        try {
            return $this->model->findOrfail($id);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function store($data)
    {
        try {
            $data['password'] = bcrypt($data['password']);
            $user = $this->model->create($data);
            if (!isset($data['role'])) {
                throw new \Exception("Role not provided.");
            }
            $roleId = Role::where('id', $data['role'])->first();
            $user->assignRole([$roleId->id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            $user = $this->model->findOrfail($id);
            $user->update($data);
            $roleId = (int)$data['role'] ?? null;
            $user->syncRoles([$roleId]);
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->model->findOrfail($id);
            $user->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    public function getAllRoles()
    {
        try {
            return Role::all();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getAccountTypes()
    {
        return AccountType::all();
    }

}
