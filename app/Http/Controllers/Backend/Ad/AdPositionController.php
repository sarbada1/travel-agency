<?php

namespace App\Http\Controllers\Backend\Ad;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Ad\AdPositionCreateRequest;
use App\Repositories\Ad\AdPositionInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdPositionController extends BackendController
{
    protected $adPositionInterface;

    public function __construct(AdPositionInterface $adPositionInterface)
    {
        parent::__construct();
        $this->adPositionInterface = $adPositionInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_list');
        $this->data('positions', $this->adPositionInterface->all());
        return view($this->pagePath . 'ad.position.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_create');
        return view($this->pagePath . 'ad.position.create', $this->data);
    }

    public function store(AdPositionCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_create');
        $data = $request->all();
        
        if ($this->adPositionInterface->insert($data)) {
            return redirect()->route('manage-ad-position.index')->with('success', 'Ad position created successfully');
        } else {
            return redirect()->back()->with('error', 'Ad position could not be created');
        }
    }

    public function show(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_show');
        $this->data('position', $this->adPositionInterface->getById($id));
        return view($this->pagePath . 'ad.position.show', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_edit');
        $this->data('position', $this->adPositionInterface->getById($id));
        return view($this->pagePath . 'ad.position.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_edit');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ad_positions')->ignore($id),
            ],
            'description' => 'nullable|string',
        ]);
        
        $data = $request->all();
        
        if ($this->adPositionInterface->update($data, $id)) {
            return redirect()->route('manage-ad-position.index')->with('success', 'Ad position updated successfully');
        } else {
            return redirect()->back()->with('error', 'Ad position could not be updated');
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_positions_delete');
        
        if ($this->adPositionInterface->delete($id)) {
            return redirect()->route('manage-ad-position.index')->with('success', 'Ad position deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Ad position could not be deleted');
        }
    }
}