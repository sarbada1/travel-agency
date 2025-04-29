<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Blog\BlogCategoyCreateRequest;
use App\Http\Requests\News\NewsCategoryCreateRequest;
use App\Repositories\News\Category\NewsCategoryInterface;
use Illuminate\Http\Request;


class NewsCategoryController extends BackendController
{
    protected NewsCategoryInterface $cat;

    public function __construct(NewsCategoryInterface $cat)
    {
        parent::__construct();
        $this->cat = $cat;
    }

    public function index(Request $request)
    {

        $this->checkAuthorization($request->user(), 'news_categories_list');
        $categoryData = $this->cat->getParentData();
        $this->data('categoryData', $categoryData);
        $response = view($this->pagePath . 'news.category.index', $this->data);
        return $response;
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'news_categories_create');
        $this->data('courseData', $this->cat->getParentData());
        return view($this->pagePath . 'news.category.create', $this->data);

    }

    public function store(NewsCategoryCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'news_categories_create');
        $data = $request->all();
        $data['slug'] = $this->make_slug($request->name);
        if ($this->cat->insert($data)) {
            return redirect()->route('manage-news-category.index')->with('success', 'data was inserted');
        } else {
            return redirect()->back()->with('error', 'data was not inserted');
        }

    }

    public function show(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'news_categories_show');
        $this->data('category', $this->cat->getById($id));
        $this->data('courseData', $this->cat->getParentData());

        return view($this->pagePath . 'news.category.show', $this->data);
    }

    public function edit(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'news_categories_edit');
        $this->data('category', $this->cat->getById($id));
        $this->data('courseData', $this->cat->getParentData());
        $this->data('parentId', $this->cat->getById($id)->parent_id);
        return view($this->pagePath . 'news.category.edit', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'news_categories_edit');
        $request->validate([
            'name' => 'required|unique:news_categories,name,' . $id,
            'slug' => 'required|unique:news_categories,slug,' . $id,
            'parent_id' =>  function ($attribute, $value, $fail) use ($id) {
                if ($value == $id) {
                    $fail('The category cannot be its own parent.');
                }
            }
        ]);
        $data = $request->all();

        $data['slug'] = $this->make_slug($request->name);
        if ($this->cat->update($data, $id)) {
            return redirect()->route('manage-news-category.index')->with('success', 'data was updated');
        } else {
            return redirect()->back()->with('error', 'data was not updated');
        }
    }


    public function destroy(string $id)
    {
        $this->checkAuthorization(auth()->user(), 'news_categories_delete');

        try {
        if ($this->cat->delete($id)) {
            return redirect()->route('manage-news-category.index')->with('success', 'data was deleted');
        } else {
            return redirect()->back()->with('error', 'data was not deleted');
        }

    } catch(\Illuminate\Database\QueryException $e){

        return redirect()->back()->with('error', 'Cannot delete this category as it is linked to other child category.');
    }
    }


}
