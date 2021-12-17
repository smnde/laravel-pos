<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->get();
    }

    public function getById($id)
    {
        return $this->product->where('id', $id)->firstOrFail();
    }
} 