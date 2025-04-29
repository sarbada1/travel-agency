<?php

namespace App\Http\Controllers\Backend\TourPackage;

use Illuminate\Http\Request;
use App\Repositories\TourPackage\TourPackageInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\PackageAttribute\PackageAttributeInterface;
use App\Http\Requests\TourPackage\TourPackageCreateRequest;
use App\Http\Requests\TourPackage\TourPackageUpdateRequest;
use App\Http\Controllers\Backend\Common\BackendController;

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
        $data = $request->all();

        // Set boolean fields
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_popular'] = $request->has('is_popular') ? 1 : 0;

        $result = $this->tourPackage->insert($data);

        if ($result) {
            return redirect()->route('manage-tour-package.index')->with('success', 'Tour Package created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create Tour Package')->withInput();
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
            $html .= '<div class="card mb-4">';
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
        $categories = $request->input('categories', []);

        // In a real implementation, you would query your database for attributes
        // commonly used with these categories
        $attributes = [];
        $html = '';

        if (!empty($categories)) {
            // For demo, add some sample attributes based on category
            foreach ($categories as $categoryId) {
                $category = $this->category->getById($categoryId);
                if ($category) {
                    if ($category->name == 'Trekking' || $category->name == 'Hiking') {
                        $attributes[] = ['id' => 1, 'name' => 'Trek Grade', 'type' => 'text'];
                        $attributes[] = ['id' => 2, 'name' => 'Trail Condition', 'type' => 'text'];
                        $attributes[] = ['id' => 3, 'name' => 'Best Season', 'type' => 'text'];
                    }

                    if ($category->name == 'Tours' || $category->name == 'Sightseeing') {
                        $attributes[] = ['id' => 4, 'name' => 'Tour Guide Language', 'type' => 'array'];
                        $attributes[] = ['id' => 5, 'name' => 'Vehicle Type', 'type' => 'text'];
                    }
                }
            }

            // Generate HTML for these attributes
            if (!empty($attributes)) {
                foreach ($attributes as $attr) {
                    $html .= $this->generateAttributeHtml($attr['id'], $attr['name'], $attr['type']);
                }
            }
        }

        return response()->json(['attributes' => $attributes, 'html' => $html]);
    }

    private function generateAttributeHtml($id, $name, $type)
    {
        $inputHtml = '';

        switch ($type) {
            case 'text':
                $inputHtml = '<input type="text" name="attribute_' . $id . '" class="form-control">';
                break;
            case 'rich_text':
                $inputHtml = '<textarea name="attribute_' . $id . '" class="form-control" rows="3"></textarea>';
                break;
            case 'boolean':
                $inputHtml = '
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="attribute_' . $id . '" id="attr_' . $id . '" value="1">
                    <label class="form-check-label" for="attr_' . $id . '">Yes</label>
                </div>
            ';
                break;
            case 'array':
                $inputHtml = '
                <div class="attribute-array-container">
                    <div class="input-group mb-2">
                        <input type="text" name="attribute_' . $id . '[]" class="form-control" placeholder="Enter value">
                        <button type="button" class="btn btn-success add-array-item">+</button>
                    </div>
                </div>
            ';
                break;
            default:
                $inputHtml = '<input type="text" name="attribute_' . $id . '" class="form-control">';
        }

        return '
        <div class="mb-3 p-3 border rounded attribute-field" data-id="' . $id . '">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="attribute_' . $id . '">' . $name . '</label>
                <button type="button" class="btn btn-sm btn-danger remove-attribute">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            ' . $inputHtml . '
        </div>
    ';
    }
}
