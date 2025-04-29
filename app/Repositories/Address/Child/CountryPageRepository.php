<?php

namespace App\Repositories\Address\Child;

use App\Models\Address\Country;
use App\Models\Address\CountryPage;
use App\Traits\General;
use Illuminate\Support\Facades\Request;

class CountryPageRepository implements CountryPageInterface
{
    use General;

    private CountryPage $model;

    public function __construct(CountryPage $model)
    {
        $this->model = $model;
    }

    public function all($pid)
    {
        return $this->model->where('country_id', $pid)->get();
    }


    public function get($id)
    {
        return $this->model->findOrFail($id);
    }

    private function updateChildPageFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function insert(array $data)
    {
        $data['user_id'] = auth()->id();
        $lastInsertId = $this->model->create($data);
        $tableName = $this->model->getTable();
        $filePath = 'uploads/' . $tableName;
        $fileData['image'] = $this->customFileUpload($filePath);
        if ($lastInsertId) {
            $id = $lastInsertId->id;
            $this->updateChildPageFile($id, $fileData);
            return true;
        } else {
            return false;
        }

    }


    public function update(array $data, $id)
    {
        $data['user_id'] = auth()->id();
        return $this->updateChildPageFile($id, $data);

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


    public function getAll()
    {
        return $this->model->all();
    }

    public function getChild($pageId)
    {
        return $this->model->where('country_id', $pageId)->get();
    }


    public function getAllCountry()
    {

        return Country::all();
    }
}
