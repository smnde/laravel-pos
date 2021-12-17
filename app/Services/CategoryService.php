<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function create($data)
    {
        $category = Category::create(['name' => $data['name']]);
        return $category;
    }

    public function update($data, $id)
    {
        $category = $this->category->getById($id);
        $category->update(['name' => $data['name']]);
        return $category;
    }

    public function delete($id)
    {
        $this->category->getById($id)->delete();
    }
}