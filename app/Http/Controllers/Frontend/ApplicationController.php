<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog\Blog;
use App\Models\Item\Item;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Models\Job\CompanyJob;
use App\Models\Company\Company;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogComments;
use App\Models\Category\Category;
use App\Models\Job\JobApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial\Testimonial;
use App\Repositories\Category\CategoryInterface;

class ApplicationController extends Controller
{
    protected $categoryInterface;


    public function __construct(CategoryInterface $categoryInterface)
    {
        parent::__construct();
        $this->categoryInterface = $categoryInterface;
    }


    public function index()
    {
        return view('frontend.pages.home.home');
    }
    public function contact()
    {
        $settings = \App\Models\Setting\Setting::first();

        $agents = \App\Models\Team\Team::with('memberType')
           
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('frontend.pages.contact.index', [
            'settings' => $settings,
            'agents' => $agents
        ]);
    }
  }
