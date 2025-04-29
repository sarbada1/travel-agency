<?php

namespace App\Repositories\Team;

use App\Models\MemberType\MemberType;
use App\Models\Team\Team;
use App\Traits\General;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class TeamRepository implements TeamInterface
{
    use General;

    protected $model;

    public function __construct(Team $model)
    {
        $this->model = $model;
    }


    private function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);

    }

    public function all()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->findOrFail($id);
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


    public function insert($data)
    {
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = $this->generateUniqueSlug($data['name'], 'teams');
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

    public function update($data, $id)
    {
        try {
            $data['user_id'] = auth()->user()->id;
            $this->model->find($id)->update($data);
            return true;
        } catch (\Exception $e) {
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

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getMemberType()
    {
        return MemberType::all();
    }
}
