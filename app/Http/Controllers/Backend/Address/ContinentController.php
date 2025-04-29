<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Address\ContinentCreateRequest;
use App\Repositories\Address\ContinentInterface;
use Illuminate\Http\Request;

class ContinentController extends BackendController
{
    private ContinentInterface $continent;

    public function __construct(ContinentInterface $continent)
    {
        parent::__construct();
        $this->continent = $continent;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'continents_list');
        $continentData = $this->continent->all();
        $this->data('continentsData', $continentData);
        return view($this->pagePath . 'address.continent.index', $this->data);
    }


    public function create()
    {
        $this->checkAuthorization(auth()->user(), 'continents_create');
        return view($this->pagePath . 'address.continent.create', $this->data);
    }


    public function store(ContinentCreateRequest $request)
    {
        $this->checkAuthorization(auth()->user(), 'continents_create');
        $this->continent->create($request->all());
        return redirect()->route('continents.index')->with('success', 'Continent created successfully');

    }


    public function show(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'continents_show');
        $continentData = $this->continent->find($id);
        $this->data('continentData', $continentData);
        return view($this->pagePath . 'address.continent.show', $this->data);
    }


    public function edit(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'continents_edit');
        $continentData = $this->continent->find($id);
        $this->data('continentData', $continentData);
        return view($this->pagePath . 'address.continent.edit', $this->data);
    }


    public function update(Request $request, string $id)
    {
        $this->checkAuthorization(auth()->user(), 'continents_edit');
        $request->validate([
            'continent_name' => 'required|unique:continents,continent_name,' . $id,
            'continent_code' => 'required|unique:continents,continent_code,' . $id,
            'description' => 'required',
        ]);
        $this->continent->update($request->all(), $id);
        return redirect()->route('continents.index')->with('success', 'Continent updated successfully');

    }


    public function destroy(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'continents_delete');
        if ($this->continent->checkCountryExistsOrNot($id) > 0) {
            return redirect()->route('continents.index')->with('error', 'Country exists in this continent');
        } else {
            $this->continent->delete($id);
            return redirect()->route('continents.index')->with('success', 'Continent deleted successfully');
        }
    }
}
