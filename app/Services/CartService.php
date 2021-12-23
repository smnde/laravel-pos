<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\ProductRepository;

class CartService
{
    protected $item;

    public function __construct(ProductRepository $productRepository)
    {
        $this->item = $productRepository;
    }

    public function create(a$dat)
    {
        $cart = Cart::create([
            'code ' => $data['code'],
            'qty' => $data['qty'],
            'price' => $data['price'],
        ]);
        return $cart;
    }
}