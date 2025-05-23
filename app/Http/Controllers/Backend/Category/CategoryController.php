<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Attribute\AttributeInterface;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Controllers\Backend\Common\BackendController;
use App\Repositories\PackageAttribute\PackageAttributeInterface;


class CategoryController extends BackendController
{
    protected CategoryInterface $cat;
    protected PackageAttributeInterface $atr;

    public function __construct(CategoryInterface $cat, PackageAttributeInterface $atr)
    {
        parent::__construct();
        $this->cat = $cat;
        $this->atr = $atr;
    }

    public function index(Request $request)
    {

        $this->checkAuthorization($request->user(), 'categories_list');
        $categoryData = $this->cat->getParentData();
        $this->data('categories', $categoryData);
        $response = view($this->pagePath . 'category.index', $this->data);
        return $response;
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'categories_create');
        $this->data('parents', $this->cat->getParentData());
        $this->data('availableAttributes', $this->atr->getAll());
        return view($this->pagePath . 'category.create', $this->data);
    }

    public function store(CategoryCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'categories_create');
        $data = $request->all();
        $data['slug'] = $this->make_slug($request->name);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['is_main'] = $request->has('is_main') ? 1 : 0;
        
        $result = $this->cat->insert($data);
        
        if ($result) {
            // Handle the attribute associations
            $category = \App\Models\Category\Category::where('slug', $data['slug'])->first();
            
            if ($category && $request->has('attribute_ids')) {
                $syncData = [];
                
                // Fix: Use input() method with default empty array
                foreach ($request->input('attribute_ids', []) as $attributeId) {
                    $syncData[$attributeId] = [
                        'is_required' => $request->has("is_required.$attributeId") ? 1 : 0,
                        'is_featured' => $request->has("is_filterable.$attributeId") ? 1 : 0,
                        'display_order' => $request->input("display_order.$attributeId", 0),
                    ];
                }
                
                // Sync the attributes
                $category->attributes()->sync($syncData);
            }
            
            return redirect()->route('manage-category.index')->with('success', 'Category was successfully created');
        } else {
            return redirect()->back()->with('error', 'Category could not be created');
        }
    }

    public function show(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'categories_show');
        $this->data('category', $this->cat->getById($id));
        $this->data('courseData', $this->cat->getParentData());

        return view($this->pagePath . 'category.show', $this->data);
    }

    public function edit(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'categories_edit');
        $this->data('category', $this->cat->getById($id));
        $this->data('parents', $this->cat->getParentData());
        $this->data('parentId', $this->cat->getById($id)->parent_id);
        $this->data('availableAttributes', $this->atr->getAll()); // Add this line
       
        return view($this->pagePath . 'category.edit', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'categories_edit');
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
            'parent_id' =>  function ($attribute, $value, $fail) use ($id) {
                if ($value == $id) {
                    $fail('The category cannot be its own parent.');
                }
            }
        ]);
        $data = $request->all();
        $data['slug'] = $this->make_slug($request->name);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['is_main'] = $request->has('is_main') ? 1 : 0;
        
        $result = $this->cat->update($data, $id);
        
        if ($result) {
            // Handle the attribute associations
            $category = \App\Models\Category\Category::findOrFail($id);
            
            if ($request->has('attribute_ids')) {
                $syncData = [];
                
                // Use input() method with default empty array
                foreach ($request->input('attribute_ids', []) as $attributeId) {
                    $syncData[$attributeId] = [
                        'is_required' => $request->has("is_required.$attributeId") ? 1 : 0,
                        'is_featured' => $request->has("is_filterable.$attributeId") ? 1 : 0, // Map filterable to featured
                        'display_order' => $request->input("display_order.$attributeId", 0),
                    ];
                }
                
                // Sync the attributes
                $category->attributes()->sync($syncData);
            } else {
                // If no attributes selected, detach all
                $category->attributes()->detach();
            }
            
            return redirect()->route('manage-category.index')->with('success', 'Category was successfully updated');
        } else {
            return redirect()->back()->with('error', 'Category could not be updated');
        }
    }


    public function destroy(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'categories_delete');

        try {
            if ($this->cat->delete($id)) {
                return redirect()->route('manage-category.index')->with('success', 'data was deleted');
            } else {
                return redirect()->back()->with('error', 'data was not deleted');
            }
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->back()->with('error', 'Cannot delete this category as it is linked to other child category.');
        }
    }

    public function updateAttributes(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'categories_edit');
        
        // Use your repository or direct model
        $category = \App\Models\Category\Category::findOrFail($id);
        
        // Prepare the sync data
        $syncData = [];
        
        if ($request->has('attribute_ids')) {
            // Fix: Use input() method with default empty array
            foreach ($request->input('attribute_ids', []) as $attributeId) {
                $syncData[$attributeId] = [
                    'is_required' => $request->has("is_required.$attributeId") ? 1 : 0,
                    'is_featured' => $request->has("is_filterable.$attributeId") ? 1 : 0, // Map filterable to featured
                    'display_order' => $request->input("display_order.$attributeId", 0),
                ];
            }
            
            // Sync the attributes
            $category->attributes()->sync($syncData);
        } else {
            // If no attributes selected, detach all
            $category->attributes()->detach();
        }
        
        return redirect()->route('manage-category.edit', $id)
            ->with('success', 'Category attributes have been updated');
    }
}
