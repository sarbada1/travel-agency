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
        
        $attributeGroups = \App\Models\TourPackage\AttributeGroup::with(['attributes' => function($query) {
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
        $data = $request->validated();
        
        // Set boolean fields
        $data['is_featured'] = $request->has('is_featured');
        $data['is_popular'] = $request->has('is_popular');
        
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
        $attributeGroups = \App\Models\TourPackage\AttributeGroup::with(['attributes' => function($query) {
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
}