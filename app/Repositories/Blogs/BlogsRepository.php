<?php

namespace App\Repositories\Blogs;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Traits\General;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class BlogsRepository implements BlogsInterface
{
    use General;

    protected $model;

    public function __construct(Blog $model)
    {

        $this->model = $model;

    }

    private function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);

    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function paginate($perPage = null)
    {
        return $this->model->paginate($perPage);
    }

    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }

    public function insert(array $data)
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['slug']);
        if ($this->model->create($data)) {
            $tableName = $this->model->getTable();
            $lastId = $this->model->latest()->first()->id;
            $filePath = 'uploads/' . $tableName;
            $fileData['image'] = $this->customFileUpload($filePath);
            $this->updateFile($lastId, $fileData);
            return true;
        } else {
            return false;

        }

    }

    public function update(array $data, $id)
    {
        if ($this->model->findOrFail($id)->update($data)) {
            $post = $this->model->findOrFail($id);
            return true;
        } else {
            return false;
        }

    }


    public function delete($id)
    {

        $http_s = "";
        if (Request::isSecure()) {
            $http_s .= 'https:';
        } else {
            $http_s .= 'http:';
        }
        $post = $this->model->findOrFail($id);
        $descriptionImage = $post->description;
        $arrayDescription = explode('src="', $descriptionImage);
        $imageUrlsDescription = [];
        foreach ($arrayDescription as $item) {
            preg_match('/' . $http_s . '\/\/[^"\']+/', $item, $matches);
            if (!empty($matches[0])) {
                $imageUrlsDescription[] = $matches[0];
            }
        }
        foreach ($imageUrlsDescription as $item) {
            $imagePath = parse_url($item, PHP_URL_PATH);
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }

        $summaryImage = $post->summary;
        $summaryDescription = explode('src="', $summaryImage);
        $imageUrlsSummary = [];
        foreach ($summaryDescription as $item) {
            preg_match('/' . $http_s . '\/\/[^"\']+/', $item, $matches);
            if (!empty($matches[0])) {
                $imageUrlsSummary[] = $matches[0];
            }
        }
        foreach ($imageUrlsSummary as $item) {
            $sPath = parse_url($item, PHP_URL_PATH);
            if (file_exists(public_path($sPath))) {
                unlink(public_path($sPath));
            }
        }
        $realPath = $post->image;
        $filePath = public_path($realPath);
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }
        if ($post->delete()) {
            return true;
        } else {
            return false;
        }
    }


    public function getParentData()
    {
        return $this->model->whereNull('parent_id')->orderBy('id', 'desc')->get();
    }

    public function getParentCategory()
    {
        return BlogCategory::whereNull('parent_id')->get();
    }

    public function getSelectedParentId($id)
    {
        return $this->model->findOrFail($id)->parent_id;
    }

    public function getSelectedCategoryId($id)
    {
        return $this->model->findOrFail($id)->category_id;
    }

    public function getAllCategory()
    {
        return BlogCategory::all();
    }

    public function recentBlog($limit = 4)
    {
        return $this->model->orderBy('id', 'desc')->limit($limit)->get();
    }

}

