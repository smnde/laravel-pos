<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->get();
    }

    public function getById($id)
    {
        return $this->category->where('id', $id)->firstOrFail();
    }
}