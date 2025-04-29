<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        parent::__construct();
        $this->categoryInterface = $categoryInterface;
    }

    public function getHomeCategories()
    {
        // Get all parent categories with their children
        $this->data('parentCategories', $this->categoryInterface->getParentData());
        
        // No need for icon mapping as icons are stored in the database
        return $this->data;
    }
}