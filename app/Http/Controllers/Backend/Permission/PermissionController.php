<?php

namespace App\Http\Controllers\Backend\Permission;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Permissions\PermissionCreateRequest;
use App\Repositories\Permission\PermissionInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PermissionController extends BackendController
{
    protected PermissionInterface $pI;

    function __construct(PermissionInterface $permissionInterface)
    {
        parent::__construct();
        $this->pI = $permissionInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'permissions_list');
        return view('backend.pages.permission.index');
    }


    public function allPermission(Request $request): JsonResponse
    {
        $this->checkAuthorization($request->user(), 'permissions_list');
        $sectionData = $this->pI->all();
        return response()->json($sectionData);
    }

    public function store(PermissionCreateRequest $request): JsonResponse
    {
        $this->checkAuthorization($request->user(), 'permissions_create');
        $this->pI->store($request->all());
        return response()->json(['success' => 'Permission created successfully']);
    }

    public function delete(Request $request): JsonResponse
    {
        $this->checkAuthorization($request->user(), 'permissions_delete');
        $totalData = DB::table('role_has_permissions')->where('permission_id', $request->id)->count();
        if ($totalData > 0) {
            return response()->json(['error' => 'Permission is already in use']);
        } else {
            $response = $this->pI->delete($request->id);
            if (!$response) {
                return response()->json(['error' => 'Section is already in use']);
            } else {
                return response()->json(['success' => 'Section deleted successfully']);
            }
        }
    }

    public function edit(Request $request): JsonResponse
    {
        $this->checkAuthorization($request->user(), 'permissions_edit');
        $sectionData = $this->pI->show($request->id);
        return response()->json($sectionData);
    }

    public function update(Request $request)
    {
        $this->checkAuthorization($request->user(), 'permissions_edit');
        $request->validate([
            'name' => 'required',
        ]);
        $this->pI->update($request->all(), $request->id);
        return response()->json(['success' => 'Permission updated successfully']);
    }
}
