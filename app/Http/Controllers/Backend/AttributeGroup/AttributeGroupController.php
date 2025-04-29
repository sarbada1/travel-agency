<?php

namespace App\Http\Controllers\Backend\AttributeGroup;

use Illuminate\Http\Request;
use App\Repositories\AttributeGroup\AttributeGroupInterface;
use App\Http\Requests\AttributeGroup\AttributeGroupCreateRequest;
use App\Http\Controllers\Backend\Common\BackendController;

class AttributeGroupController extends BackendController
{
    protected AttributeGroupInterface $attributeGroup;

    public function __construct(AttributeGroupInterface $attributeGroup)
    {
        parent::__construct();
        $this->attributeGroup = $attributeGroup;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_list');
        $attributeGroups = $this->attributeGroup->getAll();
        $this->data('attributeGroups', $attributeGroups);
        return view($this->pagePath . 'attribute_group.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_create');
        return view($this->pagePath . 'attribute_group.create', $this->data);
    }

    public function store(AttributeGroupCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_create');
        $data = $request->validated();
        
        // Set boolean fields
        $data['active'] = $request->has('active');
        
        $result = $this->attributeGroup->insert($data);
        
        if ($result) {
            return redirect()->route('manage-attribute-group.index')->with('success', 'Attribute Group created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create Attribute Group')->withInput();
        }
    }

    public function show(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_show');
        $attributeGroup = $this->attributeGroup->getById($id);
        $this->data('attributeGroup', $attributeGroup);
        return view($this->pagePath . 'attribute_group.show', $this->data);
    }

    public function edit(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_edit');
        $attributeGroup = $this->attributeGroup->getById($id);
        $this->data('attributeGroup', $attributeGroup);
        return view($this->pagePath . 'attribute_group.edit', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_edit');
     $data=$request->all();
     $data['active'] = $request->has('active') ? 1 : 0;

        $result = $this->attributeGroup->update($data, $id);
        
        if ($result) {
            return redirect()->route('manage-attribute-group.index')->with('success', 'Attribute Group updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update Attribute Group')->withInput();
        }
    }

    public function destroy(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'attribute_groups_delete');
        $result = $this->attributeGroup->delete($id);
        
        if ($result) {
            return redirect()->route('manage-attribute-group.index')->with('success', 'Attribute Group deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Cannot delete this Attribute Group as it has attributes associated with it');
        }
    }
}