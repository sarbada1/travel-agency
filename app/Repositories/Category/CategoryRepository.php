<?php

namespace App\Repositories\Category;

use App\Traits\General;
use Illuminate\Support\Str;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Request;

class CategoryRepository implements CategoryInterface
{
    use General;

    private $model;


    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    public function query()
    {
        return $this->model->query();
    }
    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }
    public function getBySlug($slug)
    {
        return $this->model->where('slug',$slug)->first();
    }

    private function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);

    }


public function insert(array $data)
{
    $data['user_id'] = auth()->id();
    $data['slug'] = Str::slug($data['slug']);
    
    // Extract image file from data before creating the record
    $imageFile = null;
    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
        $imageFile = $data['image'];
        unset($data['image']); // Remove from data array to prevent storing temp path
    }
    
    // Create the record
    $category = $this->model->create($data);
    
    if ($category) {
        // Now handle the file upload if we have an image
        if ($imageFile) {
            $tableName = $this->model->getTable();
            $filePath = 'uploads/' . $tableName;
            $fileData['image'] = $this->customFileUpload($filePath, 'image', $imageFile);
            $category->update($fileData);
        }
        
        return true;
    } else {
        return false;
    }
}

public function update(array $data, $id)
{
    $data['user_id'] = auth()->user()->id;
    
    // Extract image file from data before updating the record
    $imageFile = null;
    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
        $imageFile = $data['image'];
        unset($data['image']); // Remove from data array to prevent storing temp path
    }
    
    // Update the category
    $category = $this->model->findOrFail($id);
    $category->update($data);
    
    // Now handle the file upload if we have an image
    if ($imageFile) {
        // Delete old image if it exists
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }
        
        $tableName = $this->model->getTable();
        $filePath = 'uploads/' . $tableName;
        $fileData['image'] = $this->customFileUpload($filePath, 'image', $imageFile);
        $category->update($fileData);
    }
    
    return true;
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


