<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Page\PageChildCreateRequest;
use App\Repositories\Address\Child\CountryPageInterface;
use Illuminate\Http\Request;

class CountryPageController extends BackendController
{
    protected CountryPageInterface $pChild;

    public function __construct(CountryPageInterface $pChild)
    {
        parent::__construct();
        $this->pChild = $pChild;
    }

    public function index(Request $request)
    {
        $pid = $request->pid;
        $postsData = $this->pChild->getChild($pid);
        $this->data('pageChildData', $postsData);
        $this->data('pageId', $pid);
        return view($this->pagePath . 'address.country.child.index', $this->data);
    }

    public function create($pid)
    {
        $this->data('pid', $pid);
        return view($this->pagePath . 'address.country.child.create', $this->data);
    }

    public function store(PageChildCreateRequest $request)
    {
        $data = $request->all();
        $data['country_id'] = $request->pid;
        if ($data) {
            $this->pChild->insert($data);
            return redirect()->back()->with('success', 'data was inserted');
        } else {
            return redirect()->back()->with('error', 'data was not inserted');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->pid;
        $this->data('pcData', $this->pChild->get($id));
        $this->data('allPage', $this->pChild->getAllCountry());
        return view($this->pagePath . 'address.country.child.update', $this->data);
    }

    public function update(Request $request)
    {
        $id = $request->pid;
        $data = $request->all();
        if ($data) {
            $this->pChild->update($data, $id);
            return redirect()->back()->with('success', 'country page data was updated');
        } else {
            return redirect()->back()->with('error', 'data was not updated');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->pid;
        if ($id) {
            $this->pChild->delete($id);
            return redirect()->back()->with('success', 'data was deleted');
        } else {
            return redirect()->back()->with('error', 'data was not deleted');
        }
    }
}
