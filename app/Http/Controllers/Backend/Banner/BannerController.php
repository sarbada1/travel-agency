<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Banner\BannerCreateRequest;
use App\Models\Banner\Banner;
use App\Repositories\Banner\BannerInterface;
use Illuminate\Http\Request;

class BannerController extends BackendController
{
    protected $bannerRepository;

    public function __construct(BannerInterface $bannerRepository)
    {
        parent::__construct();
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Display a listing of the banners.
     */
    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'banners_list');
        $banners = $this->bannerRepository->getAllBanners();
        return view($this->pagePath . 'banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'banners_create');
        $positions = Banner::positions();
        return view($this->pagePath . 'banner.create', compact('positions'));
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        $this->checkAuthorization($request->user(), 'banners_create');
        
        // Validate the request
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'position' => 'required|string|max:50',
            'media_type' => 'required|in:image,video',
            'sort_order' => 'nullable|integer|min:0',
            ]);
        
        $data = $request->all();
        
        // Handle is_active checkbox
        $data['is_active'] = $request->has('is_active');
        
        $banner = $this->bannerRepository->storeBanner($data);
        
        return redirect()->route('banner.index')
            ->with('success', 'Banner created successfully');
    }

    /**
     * Display the specified banner.
     */
    public function show(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'banners_show');
        $banner = $this->bannerRepository->getBanner($id);
        return view($this->pagePath . 'banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'banners_edit');
        $banner = $this->bannerRepository->getBanner($id);
        $positions = Banner::positions();
        return view($this->pagePath . 'banner.edit', compact('banner', 'positions'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'banners_edit');
        
        // Get the current banner to check existing media type
        $banner = $this->bannerRepository->getBanner($id);
        
        // Validate the request
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
             ]);
        
        $data = $request->all();
        
        // Handle is_active checkbox
        $data['is_active'] = $request->has('is_active');
        
        $this->bannerRepository->updateBanner($data, $id);
        
        return redirect()->route('banner.index')
            ->with('success', 'Banner updated successfully');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'banners_delete');
        $this->bannerRepository->deleteBanner($id);
        
        return redirect()->route('banner.index')
            ->with('success', 'Banner deleted successfully');
    }
}