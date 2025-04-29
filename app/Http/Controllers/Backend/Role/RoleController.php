<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Repositories\Roles\RolesInterface;
use Illuminate\Http\Request;

class RoleController extends BackendController
{

    protected $roleInterface;

    function __construct(RolesInterface $roleInterface)
    {
        parent::__construct();
        $this->roleInterface = $roleInterface;
    }


    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'roles_list');
        $roles = $this->roleInterface->index();
        $this->data('roles', $roles);
        return view('backend.pages.roles.index', $this->data);
    }


    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'roles_create');
        $this->data('permission', $this->roleInterface->create());
        return view('backend.pages.roles.create', $this->data);
    }


    public function store(RoleCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'roles_create');
        $this->roleInterface->store($request->all());
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $findData = $this->roleInterface->show($id);
        $this->data('role', $findData['role']);
        $this->data('rolePermissions', $findData['rolePermissions']);
        return view('backend.pages.roles.show', $this->data);
    }

    public function edit($id)
    {
        $this->checkAuthorization(auth()->user(), 'roles_edit');
        $findData = $this->roleInterface->edit($id);
        $this->data('role', $findData['role']);
        $this->data('permission', $findData['permission']);
        $this->data('rolePermissions', $findData['rolePermissions']);
        return view('backend.pages.roles.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'roles_edit');
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        $this->roleInterface->update($request->all(), $id);
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }


    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), 'roles_delete');
        $this->roleInterface->destroy($id);
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
