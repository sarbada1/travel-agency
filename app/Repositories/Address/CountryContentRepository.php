<?php

namespace App\Repositories\Address;

use App\Models\Address\Country;
use App\Models\Address\CountryContent;
use App\Traits\General;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class CountryContentRepository implements CountryContentInterface
{

    use General;

    private $content;

    public function __construct(CountryContent $content)
    {
        $this->content = $content;

    }


    public function find($id)
    {
        try {
            return $this->content->find($id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function updateFile($id, $data)
    {
        return $this->content->findOrFail($id)->update($data);
    }


    public function insertData($data)
    {

        $data['slug'] = Str::slug($data['slug']);
        $lastInsertId = $this->content->create($data);
        $tableName = $this->content->getTable();
        $filePath = 'uploads/' . $tableName;
        $fileData['image'] = $this->customFileUpload($filePath);
        $this->updateFile($lastInsertId->id, $fileData);
        return true;

    }

    public function update($data, $id)
    {
        return $this->content->findOrFail($id)->update($data);

    }

    public function delete($id)
    {
        $http_s = "";

        if (Request::isSecure()) {
            $http_s .= 'https:';
        } else {
            $http_s .= 'http:';
        }

        $post = $this->content->findOrFail($id);

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
        $arraySummary = explode('src="', $summaryImage);
        $imageUrlsSummary = [];
        foreach ($arraySummary as $item) {
            preg_match('/' . $http_s . '\/\/[^"\']+/', $item, $matches);
            if (!empty($matches[0])) {
                $imageUrlsSummary[] = $matches[0];
            }
        }
        foreach ($imageUrlsSummary as $item) {
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


    public function getCountryById($id)
    {
        return Country::findOrfail($id);
    }


    public function allCountry()
    {
        return Country::all();
    }


}
