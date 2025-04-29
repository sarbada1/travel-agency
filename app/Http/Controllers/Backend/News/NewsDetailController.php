<?php

namespace App\Http\Controllers\Backend\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\News\NewsInterface;
use App\Http\Requests\News\NewsDetailCreateRequest;
use App\Repositories\News\Detail\NewsDetailInterface;
use App\Http\Controllers\Backend\Common\BackendController;

class NewsDetailController extends BackendController
{
    protected $newsDetailInterface;
    protected $newsInterface;

    public function __construct(NewsDetailInterface $newsDetailInterface, NewsInterface $newsInterface)
    {
        parent::__construct();
        $this->newsDetailInterface = $newsDetailInterface;
        $this->newsInterface = $newsInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(request()->user(), 'news_edit');
        
        $newsId = $request->news_id;
        if (!$newsId) {
            return redirect()->route('manage-news.index')
                ->with('error', 'News ID is required');
        }
        
        $news = $this->newsInterface->getById($newsId);
        $details = $this->newsDetailInterface->getByNewsId($newsId);
        
        foreach ($details as $detail) {
            if ($detail->image) {
                $detail->image = (string)$detail->image;
            }
            if ($detail->video_url) {
                $detail->video_url = (string)$detail->video_url;
            }
        }

        return view($this->pagePath . 'news.details.index', [
            'news' => $news,
            'details' => $details
        ]);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization(auth()->user(), 'news_edit');
        
        $newsId = $request->news_id;
        if (!$newsId) {
            return redirect()->route('manage-news.index')
                ->with('error', 'News ID is required');
        }
        
        $news = $this->newsInterface->getById($newsId);
        
        return view($this->pagePath . 'news.details.create', [
            'news' => $news
        ]);
    }

    public function store(NewsDetailCreateRequest $request)
    {
        $this->checkAuthorization(auth()->user(), 'news_edit');
        
        $data = $request->validated();
    

        // Make sure video_url is a string, not a URL object
        if (isset($data['video_url'])) {
            $data['video_url'] = (string)$data['video_url'];
        }
        
        if ($this->newsDetailInterface->insert($data)) {
            return redirect()->route('manage-news-details.index', ['news_id' => $data['news_id']])
                ->with('success', 'News detail was added successfully');
        }
        
        return redirect()->back()->with('error', 'Failed to add news detail');
    }

    public function edit($id)
    {
        $this->checkAuthorization(auth()->user(), 'news_edit');
        
        $detail = $this->newsDetailInterface->getById($id);
        
        return view($this->pagePath . 'news.details.edit', [
            'detail' => $detail
        ]);
    }

    public function update(NewsDetailCreateRequest $request, $id)
    {
        $this->checkAuthorization(auth()->user(), 'news_edit');
        
        $data = $request->validated();
        
        if ($this->newsDetailInterface->update($data, $id)) {
            return redirect()->route('manage-news-details.index', ['news_id' => $data['news_id']])
                ->with('success', 'News detail was updated successfully');
        }
        
        return redirect()->back()->with('error', 'Failed to update news detail');
    }

    public function show($newsId)
    {
        $this->checkAuthorization(auth()->user(), 'news_view');
        
        if (!$newsId) {
            return redirect()->route('manage-news.index')
                ->with('error', 'News ID is required');
        }
        
        $news = $this->newsInterface->getById($newsId);
        $details = $this->newsDetailInterface->getByNewsId($newsId);
        
        return view($this->pagePath . 'news.details.show', [
            'news' => $news,
            'details' => $details
        ]);
    }
    
    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), 'news_edit');
        
        $detail = $this->newsDetailInterface->getById($id);
        $newsId = $detail->news_id;
        
        if ($this->newsDetailInterface->delete($id)) {
            return redirect()->route('manage-news-details.index', ['news_id' => $newsId])
                ->with('success', 'News detail was deleted successfully');
        }
        
        return redirect()->back()->with('error', 'Failed to delete news detail');
    }

    public function updateOrder(Request $request)
    {
        $this->checkAuthorization(auth()->user(), 'news_edit');
        
        try {
            // Validate the items array
            $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|integer|exists:news_details,id',
                'items.*.sort_order' => 'required|integer'
            ]);
            
            // Update the sort order for each item
            foreach ($request->items as $item) {
                DB::table('news_details')
                    ->where('id', $item['id'])
                    ->update(['sort_order' => $item['sort_order']]);
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}