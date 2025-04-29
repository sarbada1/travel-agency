<?php

namespace App\Http\Controllers\Backend\PackageAttribute;

use Illuminate\Http\Request;
use App\Repositories\PackageAttribute\PackageAttributeInterface;
use App\Repositories\AttributeGroup\AttributeGroupInterface;
use App\Http\Requests\PackageAttribute\PackageAttributeCreateRequest;
use App\Http\Requests\PackageAttribute\PackageAttributeUpdateRequest;
use App\Http\Controllers\Backend\Common\BackendController;

class PackageAttributeController extends BackendController
{
    protected PackageAttributeInterface $packageAttribute;
    protected AttributeGroupInterface $attributeGroup;

    public function __construct(
        PackageAttributeInterface $packageAttribute,
        AttributeGroupInterface $attributeGroup
    ) {
        parent::__construct();
        $this->packageAttribute = $packageAttribute;
        $this->attributeGroup = $attributeGroup;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_list');
        $packageAttributes = $this->packageAttribute->getAll();
        $this->data('packageAttributes', $packageAttributes);
        return view($this->pagePath . 'package_attribute.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_create');
        $attributeGroups = $this->attributeGroup->getActiveGroups();
        $this->data('attributeGroups', $attributeGroups);
        return view($this->pagePath . 'package_attribute.create', $this->data);
    }

    public function store(PackageAttributeCreateRequest $request)
    {
        dd($request->all());
        $this->checkAuthorization($request->user(), 'package_attributes_create');
        $data = $request->validated();
        
        $data['is_required'] = $request->has('is_required');
        $data['is_filterable'] = $request->has('is_filterable');
        $data['active'] = $request->has('active');
        
        $result = $this->packageAttribute->insert($data);
        
        if ($result) {
            return redirect()->route('manage-package-attribute.index')->with('success', 'Package Attribute created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create Package Attribute')->withInput();
        }
    }

    public function show(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_show');
        $packageAttribute = $this->packageAttribute->getById($id);
        $this->data('packageAttribute', $packageAttribute);
        return view($this->pagePath . 'package_attribute.show', $this->data);
    }

    public function edit(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_edit');
        $packageAttribute = $this->packageAttribute->getById($id);
        $attributeGroups = $this->attributeGroup->getActiveGroups();
        $this->data('packageAttribute', $packageAttribute);
        $this->data('attributeGroups', $attributeGroups);
        return view($this->pagePath . 'package_attribute.edit', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_edit');
        $data = $request->validated();
        
        // Set boolean fields
        $data['is_required'] = $request->has('is_required');
        $data['is_filterable'] = $request->has('is_filterable');
        $data['active'] = $request->has('active');
        
        $result = $this->packageAttribute->update($data, $id);
        
        if ($result) {
            return redirect()->route('manage-package-attribute.index')->with('success', 'Package Attribute updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update Package Attribute')->withInput();
        }
    }

    public function destroy(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_delete');
        $result = $this->packageAttribute->delete($id);
        
        if ($result) {
            return redirect()->route('manage-package-attribute.index')->with('success', 'Package Attribute deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Cannot delete this Package Attribute as it has values associated with it');
        }
    }
}