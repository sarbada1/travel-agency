<?php

namespace App\Http\Controllers\Backend\Account\AccountType;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\User\AccountTypeCreateRequest;
use App\Repositories\Account\AccountType\AccountTypeInterface;
use Illuminate\Http\Request;

class AccountTypeController extends BackendController
{
    protected $pI;

    function __construct(AccountTypeInterface $mType)
    {
        parent::__construct();
        $this->pI = $mType;
    }


    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'account_types_list');
        return view($this->pagePath . 'account.account-type.index');
    }


    public function allAccountType(Request $request)
    {
        $this->checkAuthorization($request->user(), "account_types_list");
        $sectionData = $this->pI->all();
        return response()->json($sectionData);
    }

    public function store(AccountTypeCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'account_types_create');
        $this->pI->create($request->all());
        return response()->json(['success' => 'Account Types created successfully']);
    }

    public function delete(Request $request)
    {
        $this->checkAuthorization($request->user(), 'account_types_delete');
        $response = $this->pI->delete($request->id);
        if (!$response) {
            return response()->json(['error' => 'Account Types is already in use']);
        } else {
            return response()->json(['success' => 'Account Types deleted successfully']);
        }

    }

    public function edit(Request $request)
    {
        $this->checkAuthorization($request->user(), 'account_types_edit');
        $sectionData = $this->pI->find($request->id);
        return response()->json($sectionData);
    }

    public function update(Request $request)
    {
        $this->checkAuthorization($request->user(), 'account_types_edit');
        $request->validate([
            'name' => 'required|unique:account_types,name,' . $request->id,
        ]);
        $this->pI->update($request->all(), $request->id);
        return response()->json(['success' => 'Account Type updated successfully']);
    }
}
