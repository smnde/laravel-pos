<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getAll()
    {
        return $this->order->get();
    }

    public function getById($id)
    {
        return $this->order->where('id', $id)->first();
    }
}