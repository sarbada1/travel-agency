<?php

namespace App\Repositories\Profile;
use App\Models\User\User;


class UserProfileRepository implements UserProfileInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;

    }


    public function get_profile()
    {
        $authId = auth()->user()->id;
        return $this->model->where('id', $authId)->first();
    }


    public function updateCustomPassword($data)
    {
        try {
            $authId = auth()->user()->id;
            $user = $this->model->findOrfail($authId);
            $user->password = bcrypt($data['password']);
            $user->save();
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
            if (isset($data['skill_id'])) {
                $user->userSkill()->sync($data['skill_id']);
            }
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }


}
