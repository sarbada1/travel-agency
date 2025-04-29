<?php

namespace App\Repositories\Testimonial;

use App\Models\Testimonial\Testimonial;
use App\Traits\General;
use Illuminate\Support\Facades\Request;

class TestimonialRepository implements TestimonialInterface
{
    use General;

    protected $model;

    public function __construct(Testimonial $model)
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


    public function insert(array $data)
    {

        try {
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
        } catch (\Exception $e) {
            return false;
        }


    }

    public function update(array $data, $id)
    {
        try {
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


}
