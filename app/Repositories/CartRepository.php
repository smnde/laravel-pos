<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    protected $item;

    public function __construct(Cart $cart)
    {
        $this->item = $cart;
    }

    public function getAll()
    {
        return $this->item->get();
    }

    public function getById($id)
    {
        return $this->item->where('id', $id);
    }
}