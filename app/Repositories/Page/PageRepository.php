<?php

namespace App\Repositories\Page;

use App\Models\Page\Page;
use App\Models\Page\PageFaq;
use App\Traits\General;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class PageRepository implements PageInterface
{

    use General;

    protected $model;

    public function __construct(Page $model)
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
        return $this->model->whereNull('parent_id')->get();
    }



    public function getSelectedParentId($id)
    {
        return $this->model->findOrFail($id)->parent_id;
    }



    public function insertFaq($data)
    {
        if (PageFaq::create($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFaq($id)
    {
        $faq = PageFaq::find($id);
        if ($faq->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateFaq($data, $id)
    {
        if (PageFaq::findOrFail($id)->update($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getFaq($id)
    {
        return PageFaq::findOrFail($id);
    }

}
