<?php

namespace App\Repositories\Address;


use App\Models\Address\Continents;
use App\Models\Address\Country;
use Illuminate\Support\Facades\Request;

use App\Traits\General;

class ContinentRepository implements ContinentInterface
{
    use General;

    private $continents;
    private $country;

    public function __construct(Continents $continents, Country $country)
    {
        $this->continents = $continents;
        $this->country = $country;
    }

    public function all()
    {
        try {
            return $this->continents->all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function find($id)
    {
        try {
            return $this->continents->find($id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function updateFile($id, $data)
    {
        return $this->continents->findOrFail($id)->update($data);
    }

    public function create($data)
    {
        try {
            $lastInsertId = $this->continents->create($data);
            $tableName = $this->continents->getTable();
            $filePath = 'uploads/' . $tableName;
            $fileData['image'] = $this->customFileUpload($filePath);
            if ($lastInsertId) {
                $id = $lastInsertId->id;
                $this->updateFile($id, $fileData);
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update($data, $id)
    {
        try {
            return $this->continents->findOrFail($id)->update($data);
        } catch (\Exception $e) {
            return $e->getMessage();
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

        $post = $this->continents->findOrFail($id);

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


    public function checkCountryExistsOrNot($id)
    {
        return $this->country->where('continent_id', $id)->count();
    }
}
