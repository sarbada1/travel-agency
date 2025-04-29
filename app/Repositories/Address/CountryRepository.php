<?php

namespace App\Repositories\Address;


use App\Models\Address\Continents;
use App\Models\Address\Country;
use App\Models\Address\CountryPage;
use App\Models\Address\Location;
use App\Traits\General;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class CountryRepository implements CountryInterface
{
    use General;

    private $country;
    private $continents;

    public function __construct(Country $country, Continents $continents)
    {
        $this->country = $country;
        $this->continents = $continents;

    }

    public function all()
    {
        try {
            return $this->country->all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function find($id)
    {
        try {
            return $this->country->find($id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function updateFile($id, $data)
    {
        return $this->country->findOrFail($id)->update($data);
    }

    function generateUniqueSlug($title, $tableName, $column = 'slug')
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (DB::table($tableName)->where($column, $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function create($data)
    {
        try {
            $lastInsertId = $this->country->create($data);
            $tableName = $this->country->getTable();
            $filePath = 'uploads/' . $tableName;
            $fileData['image'] = $this->customFileUpload($filePath);
            if (isset($data['tags'])) {
                $array = json_decode($data['tags'], true);
                foreach ($array as $tag) {
                    $insertData['country_id'] = $lastInsertId->id;
                    $insertData['title'] = $tag;
                    $insertData['slug'] = $this->generateUniqueSlug($tag, 'country_pages');
                    $insertData['user_id'] = auth()->id();
                    CountryPage::create($insertData);
                }
            }
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
            return $this->country->findOrFail($id)->update($data);
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

        $post = $this->country->findOrFail($id);

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

    public function getAllContinent($id = "")
    {
        try {
            return $this->continents->all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function locationImageUpload($id, $fileData)
    {
        return Location::findOrFail($id)->update($fileData);
    }


    public function addLocation($data, $countryId)
    {
        $data['country_id'] = $countryId;
        $data['user_id'] = auth()->user()->id;
        $insertData = Location::create($data);
        try {
            $lastInsertId = $insertData->id;
            $tableName = $insertData->getTable();
            $filePath = 'uploads/' . $tableName;
            $fileData['image'] = $this->customFileUpload($filePath);
            if ($lastInsertId) {
                $this->locationImageUpload($lastInsertId, $fileData);
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteDataLocation($id)
    {

        $http_s = "";

        if (Request::isSecure()) {
            $http_s .= 'https:';
        } else {
            $http_s .= 'http:';
        }

        $post = Location::findOrFail($id);

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

    public function updateLocation($data, $id)
    {
        return Location::findOrFail($id)->update($data);
    }

    public function findLocationData($id)
    {
        return Location::findOrFail($id);
    }
}
