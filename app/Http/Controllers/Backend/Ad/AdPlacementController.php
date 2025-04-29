<?php

namespace App\Http\Controllers\Backend\Ad;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Ad\AdPlacementCreateRequest;
use App\Repositories\Ad\AdInterface;
use App\Repositories\Ad\AdPlacementInterface;
use App\Repositories\Ad\AdPositionInterface;
use Illuminate\Http\Request;

class AdPlacementController extends BackendController
{
    protected $adPlacementInterface;
    protected $adInterface;
    protected $adPositionInterface;

    public function __construct(
        AdPlacementInterface $adPlacementInterface,
        AdInterface $adInterface,
        AdPositionInterface $adPositionInterface
    ) {
        parent::__construct();
        $this->adPlacementInterface = $adPlacementInterface;
        $this->adInterface = $adInterface;
        $this->adPositionInterface = $adPositionInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_list');
        $this->data('ads', $this->adInterface->getActiveAds());
        $this->data('placements', $this->adPlacementInterface->all());
        return view($this->pagePath . 'ad.placement.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_create');
        $ads = $this->adInterface->getActiveAds();
   
        
        $this->data('ads', $ads);
        $this->data('positions', $this->adPositionInterface->all());
        return view($this->pagePath . 'ad.placement.create', $this->data);
    }

    public function store(AdPlacementCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_create');
        $data = $request->all();
        
        if ($this->adPlacementInterface->insert($data)) {
            return redirect()->route('manage-ad-placement.index')->with('success', 'Ad placement created successfully');
        } else {
            return redirect()->back()->with('error', 'Ad placement could not be created');
        }
    }

    public function show(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_show');
        $this->data('placement', $this->adPlacementInterface->getById($id));
        return view($this->pagePath . 'ad.placement.show', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_edit');
        $this->data('placement', $this->adPlacementInterface->getById($id));
        $this->data('ads', $this->adInterface->getActiveAds());
        $this->data('positions', $this->adPositionInterface->all());
        return view($this->pagePath . 'ad.placement.edit', $this->data);
    }

    public function update(AdPlacementCreateRequest $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_edit');
        $data = $request->all();
        
        if ($this->adPlacementInterface->update($data, $id)) {
            return redirect()->route('manage-ad-placement.index')->with('success', 'Ad placement updated successfully');
        } else {
            return redirect()->back()->with('error', 'Ad placement could not be updated');
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_placements_delete');
        
        if ($this->adPlacementInterface->delete($id)) {
            return redirect()->route('manage-ad-placement.index')->with('success', 'Ad placement deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Ad placement could not be deleted');
        }
    }
}