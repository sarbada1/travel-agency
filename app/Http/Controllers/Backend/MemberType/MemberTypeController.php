<?php

namespace App\Http\Controllers\Backend\MemberType;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\User\MemberTypeCreateRequest;
use App\Repositories\MemberType\MemberTypeInterface;
use Illuminate\Http\Request;

class MemberTypeController extends BackendController
{
    protected $pI;

    function __construct(MemberTypeInterface $mType)
    {
        parent::__construct();
        $this->pI = $mType;
    }


    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'member_types_list');
        return view($this->pagePath . 'member-types.index');
    }


    public function allMemberType(Request $request)
    {
        $this->checkAuthorization($request->user(), 'member_types_list');
        $sectionData = $this->pI->all();
        return response()->json($sectionData);
    }

    public function store(MemberTypeCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'member_types_create');
        $this->pI->store($request->all());
        return response()->json(['success' => 'Member Types created successfully']);
    }

    public function delete(Request $request)
    {
        $this->checkAuthorization($request->user(), 'member_types_delete');
        $response = $this->pI->delete($request->id);
        if (!$response) {
            return response()->json(['error' => 'Member Types is already in use']);
        } else {
            return response()->json(['success' => 'Member Types deleted successfully']);
        }

    }

    public function edit(Request $request)
    {
        $this->checkAuthorization($request->user(), 'member_types_edit');
        $sectionData = $this->pI->show($request->id);
        return response()->json($sectionData);
    }

    public function update(Request $request)
    {
        $request->validate([
            'type' => 'required|unique:member_types,type,' . $request->id,
        ]);
        $this->checkAuthorization($request->user(), 'member_types_edit');
        $this->pI->update($request->all(), $request->id);
        return response()->json(['success' => 'Member updated successfully']);
    }

}
