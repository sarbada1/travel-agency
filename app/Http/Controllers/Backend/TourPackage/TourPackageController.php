<?php

namespace App\Http\Controllers\Backend\TourPackage;

use Log;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\TourPackage\TourPackageInterface;
use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\TourPackage\TourPackageCreateRequest;
use App\Http\Requests\TourPackage\TourPackageUpdateRequest;
use App\Repositories\PackageAttribute\PackageAttributeInterface;

class TourPackageController extends BackendController
{
    protected TourPackageInterface $tourPackage;
    protected CategoryInterface $category;
    protected PackageAttributeInterface $packageAttribute;

    public function __construct(
        TourPackageInterface $tourPackage,
        CategoryInterface $category,
        PackageAttributeInterface $packageAttribute
    ) {
        parent::__construct();
        $this->tourPackage = $tourPackage;
        $this->category = $category;
        $this->packageAttribute = $packageAttribute;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'tour_packages_list');
        $tourPackages = $this->tourPackage->getAll();
        $this->data('tourPackages', $tourPackages);
        return view($this->pagePath . 'tour_package.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'tour_packages_create');

        $categories = $this->category->getAll()->where('page_type', 'tour_package');

        $destinations = $this->category->getAll()->where('page_type', 'destination');

        $activities = $this->category->getAll()->where('page_type', 'activity');

        $attributeGroups = \App\Models\TourPackage\AttributeGroup::with(['attributes' => function ($query) {
            $query->where('active', true)->orderBy('display_order');
        }])->where('active', true)->orderBy('display_order')->get();

        $this->data('categories', $categories);
        $this->data('destinations', $destinations);
        $this->data('activities', $activities);
        $this->data('attributeGroups', $attributeGroups);

        return view($this->pagePath . 'tour_package.create', $this->data);
    }

    public function store(TourPackageCreateRequest $request)
    {
      
        $this->checkAuthorization($request->user(), 'tour_packages_create');
        
        // Debug request data
        \Log::info('Tour package submission data:', $request->all());
        
        $data = $request->all();
    
        // Make sure we have required fields
        $requiredFields = ['name', 'duration_days', 'regular_price'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                \Log::warning("Missing required field: {$field}");
                return redirect()->back()
                    ->with('error', "The {$field} field is required.")
                    ->withInput();
            }
        }
        
        // Set boolean fields
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_popular'] = $request->has('is_popular') ? 1 : 0;
        
        // Make sure user_id is set
        $data['user_id'] = auth()->id();
    
        try {
            $result = $this->tourPackage->insert($data);
            
            if ($result) {
                return redirect()->route('manage-tour-package.index')
                    ->with('success', 'Tour Package created successfully');
            } else {
                Log::error('Tour package insert returned false');
                return redirect()->back()
                    ->with('error', 'Failed to create Tour Package')
                    ->withInput();
            }
        } catch (\Exception $e) {
            \Log::error('Exception during tour package creation: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'tour_packages_show');
        $tourPackage = $this->tourPackage->getWithAttributes($id);
        $this->data('tourPackage', $tourPackage);
        return view($this->pagePath . 'tour_package.show', $this->data);
    }

    public function edit(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'tour_packages_edit');

        // Get the tour package with all its attributes
        $tourPackage = $this->tourPackage->getWithAttributes($id);

        // Get all necessary data for the form
        $categories = $this->category->getAll()->where('page_type', 'tour_package');

        // Add these missing variables
        $destinations = $this->category->getAll()->where('page_type', 'destination');
        $activities = $this->category->getAll()->where('page_type', 'activity');

        // Get attributes organized by groups
        $attributeGroups = \App\Models\TourPackage\AttributeGroup::with(['attributes' => function ($query) {
            $query->where('active', true)->orderBy('display_order');
        }])->where('active', true)->orderBy('display_order')->get();

        $this->data('tourPackage', $tourPackage);
        $this->data('categories', $categories);
        $this->data('destinations', $destinations);
        $this->data('activities', $activities);
        $this->data('attributeGroups', $attributeGroups);

        // Prepare attribute values for form
        $attributeValues = [];
        foreach ($tourPackage->attributeValues as $value) {
            $attributeValues[$value->packageAttribute->id] = $value->getValue();
        }
        $this->data('attributeValues', $attributeValues);

        return view($this->pagePath . 'tour_package.edit', $this->data);
    }

    public function update(TourPackageUpdateRequest $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'tour_packages_edit');
        $data = $request->validated();

        // Set boolean fields
        $data['is_featured'] = $request->has('is_featured');
        $data['is_popular'] = $request->has('is_popular');

        $result = $this->tourPackage->update($data, $id);

        if ($result) {
            return redirect()->route('manage-tour-package.index')->with('success', 'Tour Package updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update Tour Package')->withInput();
        }
    }

    public function destroy(string $id, Request $request)
    {
        $this->checkAuthorization($request->user(), 'tour_packages_delete');

        try {
            $result = $this->tourPackage->delete($id);

            if ($result) {
                return redirect()->route('manage-tour-package.index')->with('success', 'Tour Package deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to delete Tour Package');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot delete this Tour Package as it may have bookings associated with it.');
        }
    }

    // Add these methods to your TourPackageController

    public function getCategoryFields(Request $request)
    {
        $categories = $request->input('categories', []);

        // Get fields associated with these categories
        $fields = [];
        $html = '';

        if (!empty($categories)) {
            // Example HTML for category-specific fields
            $html .= '<div class="mb-4 card">';
            $html .= '<div class="card-header bg-light"><h5 class="mb-0">Category-Specific Fields</h5></div>';
            $html .= '<div class="card-body"><div class="row">';

            // Here you would typically fetch field definitions based on category IDs
            // For demo, we'll add sample fields based on category
            foreach ($categories as $categoryId) {
                $category = $this->category->getById($categoryId);
                if ($category) {
                    if ($category->name == 'Trekking' || $category->name == 'Hiking') {
                        $html .= '
                    <div class="mb-3 col-md-6 form-group">
                        <label for="max_altitude">Maximum Altitude (m):</label>
                        <input type="number" name="max_altitude" id="max_altitude" class="form-control" value="' . old('max_altitude') . '">
                    </div>';
                    }

                    if ($category->name == 'Tours' || $category->name == 'Sightseeing') {
                        $html .= '
                    <div class="mb-3 col-md-6 form-group">
                        <label for="transport_type">Transportation Type:</label>
                        <select name="transport_type" id="transport_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="private" ' . (old('transport_type') == 'private' ? 'selected' : '') . '>Private</option>
                            <option value="public" ' . (old('transport_type') == 'public' ? 'selected' : '') . '>Public</option>
                            <option value="mixed" ' . (old('transport_type') == 'mixed' ? 'selected' : '') . '>Mixed</option>
                        </select>
                    </div>';
                    }
                }
            }

            $html .= '</div></div></div>';
        }

        return response()->json(['html' => $html]);
    }

    public function getCategoryAttributes(Request $request)
    {
        $categoryIds = $request->input('categories', []);
        
        if (empty($categoryIds)) {
            return response()->json(['attributes' => [], 'html' => '']);
        }
        
        // Get all attributes associated with the selected categories
        $categoryAttributes = \DB::table('category_attributes')
            ->join('package_attributes', 'category_attributes.package_attribute_id', '=', 'package_attributes.id')
            ->join('attribute_groups', 'package_attributes.attribute_group_id', '=', 'attribute_groups.id')
            ->whereIn('category_attributes.category_id', $categoryIds)
            ->select(
                'package_attributes.id',
                'package_attributes.name',
                'package_attributes.slug',
                'package_attributes.type',
                'package_attributes.description',
                'attribute_groups.name as group_name',
                'category_attributes.is_required',
                'category_attributes.is_featured as is_filterable',
                'category_attributes.display_order'
            )
            ->orderBy('attribute_groups.name')
            ->orderBy('category_attributes.display_order')
            ->get();
        
        $html = '';
        $attributes = [];
        
        if ($categoryAttributes->count() > 0) {
            // Group by attribute group
            $groupedAttributes = $categoryAttributes->groupBy('group_name');
            
            foreach ($groupedAttributes as $groupName => $groupAttributes) {
                $html .= '<div class="mb-3 card">';
                $html .= '<div class="card-header bg-light">' . $groupName . '</div>';
                $html .= '<div class="card-body">';
                
                foreach ($groupAttributes as $attr) {
                    $attributes[] = $attr;
                    $html .= $this->generateAttributeHtml(
                        $attr->id, 
                        $attr->name, 
                        $attr->type, 
                        $attr->description,
                        $attr->is_required
                    );
                }
                
                $html .= '</div></div>';
            }
        } else {
            $html = '<div class="alert alert-info">No attributes found for the selected categories.</div>';
        }
        
        return response()->json([
            'attributes' => $attributes,
            'html' => $html
        ]);
    }
    
    private function generateAttributeHtml($id, $name, $type, $description = '', $isRequired = false)
    {
        $requiredStar = $isRequired ? '<span class="text-danger">*</span>' : '';
        $requiredAttr = $isRequired ? 'required' : '';
        $descriptionHtml = $description ? '<small class="text-muted d-block">' . $description . '</small>' : '';
        
        $inputHtml = '';
        
        switch ($type) {
            case 'text':
                $inputHtml = '<input type="text" name="attribute_' . $id . '" class="form-control" ' . $requiredAttr . '>';
                break;
            case 'rich_text':
                $inputHtml = '<textarea name="attribute_' . $id . '" class="form-control" rows="3" ' . $requiredAttr . '></textarea>';
                break;
            case 'number':
                $inputHtml = '<input type="number" name="attribute_' . $id . '" class="form-control" ' . $requiredAttr . '>';
                break;
            case 'boolean':
                $inputHtml = '
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="attribute_' . $id . '" id="attr_' . $id . '" value="1">
                        <label class="form-check-label" for="attr_' . $id . '">Yes</label>
                    </div>
                ';
                break;
            case 'date':
                $inputHtml = '<input type="date" name="attribute_' . $id . '" class="form-control" ' . $requiredAttr . '>';
                break;
            case 'array':
            case 'json':
                $inputHtml = '
                    <div class="attribute-array-container">
                        <div class="mb-2 input-group">
                            <input type="text" name="attribute_' . $id . '[]" class="form-control" placeholder="Enter value" ' . $requiredAttr . '>
                            <button type="button" class="btn btn-success add-array-item">+</button>
                        </div>
                    </div>
                ';
                break;
            default:
                $inputHtml = '<input type="text" name="attribute_' . $id . '" class="form-control" ' . $requiredAttr . '>';
        }
        
        return '
            <div class="p-3 mb-3 border rounded attribute-field" data-id="' . $id . '">
                <div class="mb-2 d-flex justify-content-between align-items-center">
                    <label for="attribute_' . $id . '">' . $name . ' ' . $requiredStar . '</label>
                    <button type="button" class="btn btn-sm btn-danger remove-attribute">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                ' . $descriptionHtml . '
                ' . $inputHtml . '
            </div>
        ';
    }
}
