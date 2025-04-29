<?php

namespace App\Http\Controllers\Backend\Ad;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Ad\CampaignCreateRequest;
use App\Repositories\Ad\CampaignInterface;
use Illuminate\Http\Request;

class CampaignController extends BackendController
{
    protected $campaignInterface;

    public function __construct(CampaignInterface $campaignInterface)
    {
        parent::__construct();
        $this->campaignInterface = $campaignInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'campaigns_list');
        $this->data('campaigns', $this->campaignInterface->all());
        return view($this->pagePath . 'ad.campaign.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'campaigns_create');
        return view($this->pagePath . 'ad.campaign.create', $this->data);
    }

    public function store(CampaignCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'campaigns_create');
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        
        if ($this->campaignInterface->insert($data)) {
            return redirect()->route('manage-campaign.index')->with('success', 'Campaign created successfully');
        } else {
            return redirect()->back()->with('error', 'Campaign could not be created');
        }
    }

    public function show(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'campaigns_show');
        $this->data('campaign', $this->campaignInterface->getById($id));
        return view($this->pagePath . 'ad.campaign.show', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'campaigns_edit');
        $this->data('campaign', $this->campaignInterface->getById($id));
        return view($this->pagePath . 'ad.campaign.edit', $this->data);
    }

    public function update(CampaignCreateRequest $request, $id)
    {
        $this->checkAuthorization($request->user(), 'campaigns_edit');
        $data = $request->all();
        
        if ($this->campaignInterface->update($data, $id)) {
            return redirect()->route('manage-campaign.index')->with('success', 'Campaign updated successfully');
        } else {
            return redirect()->back()->with('error', 'Campaign could not be updated');
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'campaigns_delete');
        
        if ($this->campaignInterface->delete($id)) {
            return redirect()->route('manage-campaign.index')->with('success', 'Campaign deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Campaign could not be deleted');
        }
    }

    public function dashboard()
    {
        return view($this->pagePath . 'dashboard.ad-manager');
    }
}