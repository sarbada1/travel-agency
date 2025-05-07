<?php

namespace App\Http\ViewComposers;

use App\Models\Category\Category;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        // Get main categories with their subcategories and nested subcategories
        $mainCategories = Category::where('is_main', true)
            ->where('status', 1)
            ->with(['children' => function($query) {
                $query->where('status', 1)
                    ->with(['children' => function($query) {
                        $query->where('status', 1);
                    }]);
            }])
            ->orderBy('name')
            ->get();

        $view->with('mainCategories', $mainCategories);
    }
}