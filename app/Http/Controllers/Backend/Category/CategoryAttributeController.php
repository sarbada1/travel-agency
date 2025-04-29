<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Models\Attribute\Attribute;
use App\Models\Category\Category;
use App\Repositories\Category\CategoryInterface;
use Illuminate\Http\Request;

class CategoryAttributeController extends BackendController
{
    protected CategoryInterface $cat;

    public function __construct(CategoryInterface $cat)
    {
        parent::__construct();
        $this->cat = $cat;
    }

    public function index(Request $request,$id) 
    {
        $this->checkAuthorization(auth()->user(), 'categories_edit');
        echo $id; die;
        $category = Category::findOrFail($request->category_id);
        $this->data('category', $category);
        $this->data('attributes', $category->attributes);
        $this->data('availableAttributes', Attribute::whereDoesntHave('categories', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get());
        
        return view($this->pagePath . 'category.attributes.index', $this->data);
    }

    public function store(Request $request, string $categoryId)
    {
        $this->checkAuthorization(auth()->user(), 'categories_edit');
        
        $category = Category::findOrFail($categoryId);
        $request->validate([
            'attribute_ids' => 'required|array',
            'attribute_ids.*' => 'exists:attributes,id',
            'is_required' => 'array',
            'display_order' => 'array',
        ]);
        
        $attributes = [];
        foreach ($request->attribute_ids as $key => $attributeId) {
            $attributes[$attributeId] = [
                'is_required' => isset($request->is_required[$key]) ? 1 : 0,
                'display_order' => $request->display_order[$key] ?? 0,
            ];
        }
        
        $category->attributes()->sync($attributes);
        
        return redirect()->route('manage-category-attributes.index', $categoryId)
            ->with('success', 'Category attributes have been updated');
    }

    public function update(Request $request, string $categoryId, string $attributeId)
    {
        $this->checkAuthorization(auth()->user(), 'categories_edit');
        
        $category = Category::findOrFail($categoryId);
        
        $request->validate([
            'is_required' => 'boolean',
            'display_order' => 'integer',
        ]);
        
        $category->attributes()->updateExistingPivot($attributeId, [
            'is_required' => $request->is_required,
            'display_order' => $request->display_order,
        ]);
        
        return redirect()->route('manage-category-attributes.index', $categoryId)
            ->with('success', 'Category attribute has been updated');
    }

    public function destroy(string $categoryId, string $attributeId)
    {
        $this->checkAuthorization(auth()->user(), 'categories_edit');
        
        $category = Category::findOrFail($categoryId);
        $category->attributes()->detach($attributeId);
        
        return redirect()->route('manage-category-attributes.index', $categoryId)
            ->with('success', 'Attribute has been removed from category');
    }





}