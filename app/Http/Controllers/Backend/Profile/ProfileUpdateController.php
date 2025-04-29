<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\User\PasswordChangeRequest;
use Illuminate\Http\Request;
use App\Repositories\Profile\UserProfileInterface;

class ProfileUpdateController extends BackendController
{
    private $userRepo;

    public function __construct(UserProfileInterface $userRepo)
    {
        parent::__construct();
        $this->userRepo = $userRepo;
    }


    public function profile()
    {
        $this->data('user', $this->userRepo->get_profile());
        return view($this->pagePath . 'account.profile.index', $this->data);
    }

    public function change_password()
    {
        return view($this->pagePath . 'account.profile.change-password', $this->data);
    }

    public function update_password(PasswordChangeRequest $request)
    {
        $this->userRepo->updateCustomPassword($request->validated());
        return redirect()->back()->with('success', 'Password has been updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('get')) {
            $this->data('adminData', $this->userRepo->get_profile());
            return view($this->pagePath . 'account.profile.update', $this->data);
        } else {
            $this->userRepo->update($request->all(), auth()->user()->id);
            return redirect()->back()->with('success', 'Profile has been updated successfully.');
        }
    }
}
