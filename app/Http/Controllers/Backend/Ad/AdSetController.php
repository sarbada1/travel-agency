<?php

namespace App\Http\Controllers\Backend\Ad;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Ad\AdSetCreateRequest;
use App\Repositories\Ad\AdSetInterface;
use App\Repositories\Ad\CampaignInterface;
use Illuminate\Http\Request;

class AdSetController extends BackendController
{
    protected $adSetInterface;
    protected $campaignInterface;

    public function __construct(AdSetInterface $adSetInterface, CampaignInterface $campaignInterface)
    {
        parent::__construct();
        $this->adSetInterface = $adSetInterface;
        $this->campaignInterface = $campaignInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_list');
        $this->data('adSets', $this->adSetInterface->all());
        return view($this->pagePath . 'ad.adset.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_create');
        $this->data('campaigns', $this->campaignInterface->all());
        
        // If a campaign ID is provided, pre-select it
        if ($request->has('campaign_id')) {
            $this->data('selectedCampaign', $this->campaignInterface->getById($request->campaign_id));
        }
        
        return view($this->pagePath . 'ad.adset.create', $this->data);
    }

    public function store(AdSetCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_create');
        $data = $request->all();
        
        if ($this->adSetInterface->insert($data)) {
            return redirect()->route('manage-adset.index')->with('success', 'Ad Set created successfully');
        } else {
            return redirect()->back()->with('error', 'Ad Set could not be created');
        }
    }

    public function show(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_show');
        $this->data('adSet', $this->adSetInterface->getById($id));
        return view($this->pagePath . 'ad.adset.show', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_edit');
        $this->data('adSet', $this->adSetInterface->getById($id));
        $this->data('campaigns', $this->campaignInterface->all());
        return view($this->pagePath . 'ad.adset.edit', $this->data);
    }

    public function update(AdSetCreateRequest $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_edit');
        $data = $request->all();
        
        if ($this->adSetInterface->update($data, $id)) {
            return redirect()->route('manage-adset.index')->with('success', 'Ad Set updated successfully');
        } else {
            return redirect()->back()->with('error', 'Ad Set could not be updated');
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ad_sets_delete');
        
        if ($this->adSetInterface->delete($id)) {
            return redirect()->route('manage-adset.index')->with('success', 'Ad Set deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Ad Set could not be deleted');
        }
    }

    public function getByCampaign(Request $request, $campaignId)
    {
        $adSets = $this->adSetInterface->getByCampaignId($campaignId);
        return response()->json($adSets);
    }
}