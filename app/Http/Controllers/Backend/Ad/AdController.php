<?php
namespace App\Http\Controllers\Backend\Ad;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Ad\AdCreateRequest;
use App\Repositories\Ad\AdInterface;
use App\Repositories\Ad\AdSetInterface;
use Illuminate\Http\Request;

class AdController extends BackendController
{
    protected $adInterface;
    protected $adSetInterface;

    public function __construct(AdInterface $adInterface, AdSetInterface $adSetInterface)
    {
        parent::__construct();
        $this->adInterface = $adInterface;
        $this->adSetInterface = $adSetInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ads_list');
        $this->data('ads', $this->adInterface->all());
        return view($this->pagePath . 'ad.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'ads_create');
        $this->data('adSets', $this->adSetInterface->all());
        return view($this->pagePath . 'ad.create', $this->data);
    }

    public function store(AdCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'ads_create');
        $data = $request->all();
        
        if ($this->adInterface->insert($data)) {
            return redirect()->route('manage-ad.index')->with('success', 'Ad created successfully');
        } else {
            return redirect()->back()->with('error', 'Ad could not be created');
        }
    }

    public function show(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ads_show');
        $this->data('ad', $this->adInterface->getById($id));
        return view($this->pagePath . 'ad.show', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ads_edit');
        $this->data('ad', $this->adInterface->getById($id));
        $this->data('adSets', $this->adSetInterface->all());
        return view($this->pagePath . 'ad.edit', $this->data);
    }

    public function update(AdCreateRequest $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ads_edit');
        $data = $request->all();
        
        if ($this->adInterface->update($data, $id)) {
            return redirect()->route('manage-ad.index')->with('success', 'Ad updated successfully');
        } else {
            return redirect()->back()->with('error', 'Ad could not be updated');
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'ads_delete');
        
        if ($this->adInterface->delete($id)) {
            return redirect()->route('manage-ad.index')->with('success', 'Ad deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Ad could not be deleted');
        }
    }
}