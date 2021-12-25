<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository
{
    protected $detailOrder;

    public function __construct(OrderDetail $detailOrder)
    {
        $this->detailOrder = $detailOrder;
    }

    public function getAll()
    {
        return $this->detailOrder->get();
    }

    public function getById($id)
    {
        return $this->detailOrder->where('id', $id)->first();
    }
}