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
        // dd($request->all());
        $this->checkAuthorization($request->user(), 'package_attributes_create');
        $data = $request->all();
      
        $data['is_required'] = $request->has('is_required') ? 1 : 0;
        $data['is_filterable'] = $request->has('is_filterable') ? 1 : 0;
        $data['active'] = $request->has('active') ? 1 : 0;
        
        
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

    public function update(PackageAttributeCreateRequest $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'package_attributes_edit');
        $data = $request->validated();
        
        // Convert checkbox values to integers (0 or 1)
        $data['is_required'] = $request->has('is_required') ? 1 : 0;
        $data['is_filterable'] = $request->has('is_filterable') ? 1 : 0;
        $data['active'] = $request->has('active') ? 1 : 0;
        
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

    // Add these methods to your PackageAttributeController

public function searchAttributes(Request $request)
{
    $query = $request->input('q');
    
    // Query your database for attributes matching the search term
    $attributes = $this->packageAttribute->search($query);
    
    // Transform for the response
    $formattedAttributes = [];
    foreach ($attributes as $attr) {
        $formattedAttributes[] = [
            'id' => $attr->id,
            'name' => $attr->name,
            'group_name' => $attr->attributeGroup->name ?? 'Unknown Group'
        ];
    }
    
    return response()->json(['attributes' => $formattedAttributes]);
}

public function createAttributeAjax(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'attribute_group_id' => 'required|exists:attribute_groups,id',
        'type' => 'required|in:text,rich_text,array,json,boolean,number,date'
    ]);
    
    // Generate a slug
    $slug = \Illuminate\Support\Str::slug($request->name);
    
    // Create attribute data
    $data = [
        'name' => $request->name,
        'slug' => $slug,
        'attribute_group_id' => $request->attribute_group_id,
        'type' => $request->type,
        'active' => 1
    ];
    
    // Insert the attribute
    $result = $this->packageAttribute->insert($data);
    
    if ($result) {
        // Get the created attribute
        $attribute = $this->packageAttribute->getBySlug($slug);
        return response()->json(['success' => true, 'attribute' => $attribute]);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to create attribute'], 500);
    }
}

public function getAttributeInfo($id)
{
    $attribute = $this->packageAttribute->getById($id);
    return response()->json(['attribute' => $attribute]);
}
}