<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogComments;
use App\Repositories\Blogs\BlogsInterface;

class BlogController extends Controller
{
    protected $blogInterface;

    public function __construct(BlogsInterface $blogInterface)
    {
        parent::__construct();
        $this->blogInterface = $blogInterface;
    }

    public function index(Request $request)
    {
        if (!empty($request->slug)) {
            $Blog = Blog::where('slug', $request->slug)
                ->with([
                    'category',
                    'user',
                    'details' => function ($query) {
                        $query->orderBy('sort_order', 'asc');
                    }
                ])
                ->firstOrFail();

            $Blog->increment('view_count');

            $relatedBlog = Blog::where('category_id', $Blog->category_id)
                ->where('id', '!=', $Blog->id)
                ->latest()
                ->take(2)
                ->get();

            $latestBlog = Blog::where('id', '!=', $Blog->id)
                ->latest()
                ->take(4)
                ->get();

            $comments = BlogComments::where('blog_id', $Blog->id)
                ->with(['user', 'replies.user'])
                ->whereNull('parent_id')
                ->latest()
                ->get();

            return view('frontend.pages.blog.blog-details', [
                'Blog' => $Blog,
                'relatedBlog' => $relatedBlog,
                'latestBlog' => $latestBlog,
                'comments' => $comments,
            ]);
        } else {
            $this->data('categoryData', $this->blogInterface->getAllCategory());
            $this->data('BlogData', $this->blogInterface->paginate(6));
            return view('frontend.pages.blog.index', $this->data);
        }
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'comment' => 'required|string|max:1000',
        ]);

        $userId = auth()->check() ? auth()->id() : null;

        $comment = new BlogComments();
        $comment->blog_id = $request->blog_id;
        $comment->user_id = $userId;
        $comment->body = $request->comment;
        $comment->save();

        return response()->json(['success' => true]);
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'parent_id' => 'required|exists:blog_comments,id',
            'reply' => 'required|string|max:1000',
        ]);

        $userId = auth()->check() ? auth()->id() : null;

        $reply = new BlogComments();
        $reply->blog_id = $request->blog_id;
        $reply->parent_id = $request->parent_id;
        $reply->user_id = $userId;
        $reply->body = $request->reply;
        $reply->save();

        return response()->json(['success' => true]);
    }
}
