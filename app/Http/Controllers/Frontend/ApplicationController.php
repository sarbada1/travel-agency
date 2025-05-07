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
        // Fetch popular destinations from the categories table
        $popularDestinations = $this->categoryInterface->getAll()
            ->where('page_type', 'destination')
            ->where('is_main', '!=', 1)
            ->take(6); // Limit to 6 destinations

        // Get popular tour packages for the packages section
        $popularTourPackages = \App\Models\TourPackage\TourPackage::where('status', 'active')
            ->where('is_featured', 1)
            ->take(4)
            ->get();

        return view('frontend.pages.home.home', [
            'popularDestinations' => $popularDestinations,
            'popularTourPackages' => $popularTourPackages
        ]);
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
    /**
     * Display a listing of destinations.
     */
    public function destinations(Request $request)
    {
        // Use Category model directly to get a query builder
        $query = Category::query()
            ->where('page_type', 'destination')
            ->where('is_main', '!=', 1)
            ->where('status', true);

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Apply continent filter if provided
        if ($request->has('continent') && !empty($request->continent)) {
            $query->where('region', $request->continent);
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('starting_price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('starting_price', 'desc');
                    break;
                case 'popular':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        // Paginate the results
        $destinations = $query->paginate(9)->withQueryString();

        return view('frontend.pages.destination.index', [
            'destinations' => $destinations
        ]);
    }

    public function showDestination($slug)
    {
        $destination = $this->categoryInterface->getBySlug($slug);

        if (!$destination || $destination->page_type !== 'destination') {
            abort(404);
        }

        // Get tour packages related to this destination
        $tourPackages = \App\Models\TourPackage\TourPackage::whereHas('destinations', function ($query) use ($destination) {
            $query->where('categories.id', $destination->id);
        })
            ->where('status', 'active')
            ->take(6)
            ->get();

        return view('frontend.pages.destination.show', [
            'destination' => $destination,
            'tourPackages' => $tourPackages
        ]);
    }

    public function tourPackages()
    {
        $tourPackages = \App\Models\TourPackage\TourPackage::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.pages.tour_package.index', [
            'tourPackages' => $tourPackages
        ]);
    }

    public function showTourPackage($slug)
    {
        $tourPackage = \App\Models\TourPackage\TourPackage::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Get related packages based on destinations or categories
        $relatedPackages = \App\Models\TourPackage\TourPackage::where('id', '!=', $tourPackage->id)
            ->where('status', 'active')
            ->whereHas('destinations', function ($query) use ($tourPackage) {
                $query->whereIn('categories.id', $tourPackage->destinations->pluck('id')->toArray());
            })
            ->orWhereHas('categories', function ($query) use ($tourPackage) {
                $query->whereIn('categories.id', $tourPackage->categories->pluck('id')->toArray());
            })
            ->take(3)
            ->get();

        return view('frontend.pages.tour_package.show', [
            'tourPackage' => $tourPackage,
            'relatedPackages' => $relatedPackages
        ]);
    }
}
