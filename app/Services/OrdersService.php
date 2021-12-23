<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function create()
    {
        
    }
}