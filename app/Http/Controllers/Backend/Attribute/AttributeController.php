<?php

namespace App\Http\Controllers\Backend\Attribute;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Attribute\AttributeCreateRequest;
use App\Repositories\Attribute\AttributeInterface;
use App\Repositories\AttributeGroup\AttributeGroupInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends BackendController
{
    protected AttributeInterface $attributeInterface;
    protected AttributeGroupInterface $attributeGroupInterface;

    public function __construct(AttributeInterface $attributeInterface, AttributeGroupInterface $attributeGroupInterface)
    {
        parent::__construct();
        $this->attributeInterface = $attributeInterface;
        $this->attributeGroupInterface = $attributeGroupInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'attributes_list');

        $attributes = $this->attributeInterface->getAll();
        $attributeGroups = $this->attributeGroupInterface->getAll();

        $this->data('attribute', $attributes);
        $this->data('attributeGroups', $attributeGroups);

        return view($this->pagePath . 'attribute.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'attributes_create');
        
        // Get attribute groups
        $attributeGroups = $this->attributeGroupInterface->getAll();
        $this->data('attributeGroups', $attributeGroups);
        
        // Pre-select attribute group if provided in URL path parameter
        if ($request->route('attribute_group')) {
            $groupId = $request->route('attribute_group');
            $this->data('selectedGroupId', $groupId);
            
            // Get group details to display in the form
            $selectedGroup = $this->attributeGroupInterface->getById($groupId);
            $this->data('selectedGroup', $selectedGroup);
        }
        // Alternatively, check if provided as a query parameter
        elseif ($request->has('attribute_group_id')) {
            $this->data('selectedGroupId', $request->attribute_group_id);
            
            // Get group details to display in the form
            $selectedGroup = $this->attributeGroupInterface->getById($request->attribute_group_id);
            $this->data('selectedGroup', $selectedGroup);
        }
        
        // Define input types
        $inputTypes = [
            'text' => 'Text Field',
            'number' => 'Number Field',
            'select' => 'Dropdown Select',
            'checkbox' => 'Checkbox Group',
            'radio' => 'Radio Buttons',
            'textarea' => 'Text Area',
            'date' => 'Date Picker',
            'color' => 'Color Picker',
            'email' => 'Email Field',
            'url' => 'URL Field'
        ];
        
        $this->data('inputTypes', $inputTypes);
        return view($this->pagePath . 'attribute.create', $this->data);
    }

    public function store(AttributeCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'attributes_create');

        $data = $request->validated();

        if ($this->attributeInterface->insert($data)) {
            return redirect()->route('manage-attribute.index')->with('success', 'Attribute was created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create attribute')->withInput();
        }
    }

    public function show(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'attributes_show');

        $attribute = $this->attributeInterface->getById($id);
        $this->data('attribute', $attribute);

        return view($this->pagePath . 'attribute.show', $this->data);
    }
    public function listByGroup(Request $request, string $groupId)
    {
        $this->checkAuthorization($request->user(), 'attributes_list');
        
        // Get the attribute group details
        $attributeGroup = $this->attributeGroupInterface->getById($groupId);
        
        if (!$attributeGroup) {
            return redirect()->route('manage-attribute-group.index')
                ->with('error', 'Attribute group not found');
        }
        
        // Get all attributes belonging to this group
        $attributes = $this->attributeInterface->getByGroupId($groupId);
        
        $this->data('attributes', $attributes);
        $this->data('attributeGroup', $attributeGroup);
        
        return view($this->pagePath . 'attribute.group_attributes', $this->data);
    }
    public function edit(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'attributes_edit');

        $attribute = $this->attributeInterface->getById($id);
        $attributeGroups = $this->attributeGroupInterface->getAll();

        $inputTypes = [
            'text' => 'Text Field',
            'number' => 'Number Field',
            'select' => 'Dropdown Select',
            'checkbox' => 'Checkbox Group',
            'radio' => 'Radio Buttons',
            'textarea' => 'Text Area',
            'file' => 'File Upload',
            'date' => 'Date Picker',
            'color' => 'Color Picker',
            'range' => 'Range Slider',
            'email' => 'Email Field',
            'tel' => 'Telephone Field',
            'url' => 'URL Field'
        ];

        // Format options for textarea display
        $optionValues = '';
        if (isset($attribute->options) && is_array($attribute->options)) {
            $optionValues = implode("\n", $attribute->options);
        }

        $this->data('attribute', $attribute);
        $this->data('attributeGroups', $attributeGroups);
        $this->data('inputTypes', $inputTypes);
        $this->data('optionValues', $optionValues);

        return view($this->pagePath . 'attribute.update', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'attributes_edit');

        // Check if it's an AJAX request for a status toggle
        if ($request->ajax() && $request->has('field') && in_array($request->field, ['is_filterable', 'is_searchable'])) {
            // Just update a single field
            $field = $request->field;
            $value = $request->value;

            $data = [$field => $value];
            $result = $this->attributeInterface->update($data, $id);

            return response()->json([
                'success' => $result,
                'message' => $result ? 'Status updated successfully' : 'Failed to update status'
            ]);
        }

        // Normal form submission
        $request->validate([
            'attribute_group_id' => 'required|exists:attribute_groups,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:attributes,slug,' . $id,
            'input_type' => 'required|string|in:text,number,select,checkbox,radio,textarea,file,date,color,range,email,tel,url',
            'is_required' => 'nullable',
            'is_filterable' => 'nullable',
            'is_searchable' => 'nullable',
            'display_order' => 'nullable|integer|min:0',
            'option_values' => 'required_if:input_type,select,checkbox,radio'
        ]);


        if ($this->attributeInterface->update($request->all(), $id)) {
            return redirect()->route('manage-attribute.index')->with('success', 'Attribute was updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update attribute')->withInput();
        }
    }

    public function destroy(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'attributes_delete');

        try {
            if ($this->attributeInterface->delete($id)) {
                return redirect()->route('manage-attribute.index')->with('success', 'Attribute was deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to delete attribute');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot delete this attribute as it is being used by items');
        }
    }
}
