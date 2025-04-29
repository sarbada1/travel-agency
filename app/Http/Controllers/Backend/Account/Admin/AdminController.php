<?php

namespace App\Http\Controllers\Backend\Account\Admin;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\User\UserCreateRequest;
use App\Repositories\Account\User\UserInterface;
use Illuminate\Http\Request;

class AdminController extends BackendController
{
    private $aInterface;

    public function __construct(UserInterface $adminRepository)
    {
        parent::__construct();
        $this->aInterface = $adminRepository;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'users_list');
        $this->data('adminData', $this->aInterface->get());
        return view($this->pagePath . 'account.admin.index', $this->data);
    }


    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'users_create');
        $this->data('roles', $this->aInterface->getAllRoles());
        $this->data('accountTypes', $this->aInterface->getAccountTypes());
        return view($this->pagePath . 'account.admin.create', $this->data);

    }


    public function store(UserCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'users_create');
        $this->aInterface->store($request->all());
        return redirect()->route('admin.index')->with('success', 'Admin created successfully');

    }

    public function show(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'users_show');
        $this->data('adminData', $this->aInterface->getById($id));
        $this->data('roles', $this->aInterface->getAllRoles());
        $this->data('accountTypes', $this->aInterface->getAccountTypes());
        return view($this->pagePath . 'account.admin.edit', $this->data);

    }

    public function edit(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'users_edit');
        $this->data('adminData', $this->aInterface->getById($id));
        $this->data('roles', $this->aInterface->getAllRoles());
        $this->data('accountTypes', $this->aInterface->getAccountTypes());
        return view($this->pagePath . 'account.admin.edit', $this->data);
    }


    public function update(Request $request, string $id)
    {

        $this->checkAuthorization($request->user(), 'users_edit');
        $this->aInterface->update($request->all(), $id);
        return redirect()->route('admin.index')->with('success', 'Admin updated successfully');
    }


    public function destroy(string $id)
    {
        $this->aInterface->delete($id);
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully');
    }

}
