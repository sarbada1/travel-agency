<?php

namespace App\Repositories\Blogs\Category;

use App\Models\Blog\BlogCategory;
use App\Traits\General;
use Illuminate\Support\Facades\Request;

class BlogCategoryRepository implements BlogCategoryInterface
{
    use General;

    private $model;


    public function __construct(BlogCategory $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }

    private function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);

    }

    public function insert(array $data)
    {
        try {
            $data['user_id'] = auth()->user()->id;
            if ($this->model->create($data)) {
                $tableName = $this->model->getTable();
                $lastId = $this->model->latest()->first()->id;
                $filePath = 'uploads/' . $tableName;
                $fileData['image'] = $this->customFileUpload($filePath);
                $this->updateFile($lastId, $fileData);
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;

    }

    public function update(array $data, $id)
    {

        $data['user_id'] = auth()->user()->id;
        if ($this->model->findOrFail($id)->update($data)) {
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

        if ($this->model->findOrFail($id)->delete()) {
            return true;
        } else {
            return false;
        }
    }
 
    public function getParentData()
    {
         $parents = $this->model->whereNull('parent_id')->get();
         return $parents;

    }


}


