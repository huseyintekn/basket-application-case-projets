<?php

namespace App\Repository\App\Order;

use App\Repository\BaseRepository;
use App\Models\Order\OrderItem;

class OrderItemRepository extends BaseRepository implements OrderItemInterfaceRepository
{
    protected $model;

    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function delete($id)
    {
        $this->model->where('order_id', $id)->delete();
    }

}
