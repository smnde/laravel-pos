<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductService
{
    protected $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    public function autocode()
    {
        $code = IdGenerator::generate([
            'table' => 'products',
            'length' => 8,
            'prefix' => 'BA-',
            'field' => 'code',
        ]);
        return $code;
    }

    public function create($data)
    {
        $product = Product::create([
            'code' => $data['code'],
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'stock' => 0,
            'purchase_price' => $data['purchase_price'],
            'sales_price' => $data['sales_price'],
        ]);
        return $product;
    }

    public function update($data, $id)
    {
        $product = $this->product->getById($id);
        $product->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'purchase_price' => $data['purchase_price'],
            'sales_price' => $data['sales_price'],
        ]);
        return $product;
    }

    public function delete($id)
    {
        $this->product->getById($id)->delete();
    }
}