<?php

namespace App\Http\Controllers\Backend\Country;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Country\CountryContentCreateRequest;
use App\Repositories\Address\CountryContentInterface;
use Illuminate\Http\Request;

class CountryContentController extends BackendController
{
    protected CountryContentInterface $content;

    public function __construct(CountryContentInterface $content)
    {
        parent::__construct();
        $this->content = $content;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), 'country_contents_list');
        $pid = $request->pid;
        $countryData = $this->content->getCountryById($pid);
        $this->data('countryData', $countryData);
        $this->data('pageId', $pid);
        return view($this->pagePath . 'address.country.content.index', $this->data);
    }

    public function create($pid)
    {
        $this->data('pid', $pid);
        return view($this->pagePath . 'address.country.content.create', $this->data);
    }

    public function store(CountryContentCreateRequest $request)
    {
        $data = $request->all();
        $data['parent_id'] = $request->pid;
        $this->content->insertData($data);
        return redirect()->back()->with('success', 'data was inserted');

    }

    public function edit($id)
    {
        $this->data('pcData', $this->content->find($id));
        $this->data('allPage', $this->content->allCountry($id));
        return view($this->pagePath . 'address.country.content.update', $this->data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->content->update($data, $id);
        return redirect()->back()->with('success', 'country content data was updated');

    }

    public function destroy($id)
    {
        if ($id) {
            $this->content->delete($id);
            return redirect()->back()->with('success', 'data was deleted');
        } else {
            return redirect()->back()->with('error', 'data was not deleted');
        }
    }


}
