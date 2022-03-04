<?php
namespace App\Repository\App\Order;

use App\Models\Order\OrderItem;
use App\Repository\App\Basket\BasketRepository;
use App\Repository\App\Product\ProductRepository;
use App\Repository\BaseRepository;
use App\Models\Order\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderInterfaceRepository
{
    protected $model;
    protected $orderItem;
    protected $basket;
    protected $products;

    public function __construct(Order $model, OrderItem $orderItem, BasketRepository $basket, ProductRepository $products)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->orderItem = $orderItem;
        $this->basket = $basket;
        $this->products = $products;
    }

    public function setCreate($attributes)
    {
        foreach($attributes as $attribute){
            $order = $this->model->create([
                'customerId' => 1,
                'total' => ($attribute->product->price * $attribute->quantity),
            ]);

            $this->orderItem->create([
                'order_id' => $order->order_id,
                'productId' => $attribute->product->product_id,
                'quantity' => $attribute->quantity,
                "unitPrice" => $attribute->product->price,
                "total" =>  ($attribute->product->price * $attribute->quantity),
            ]);

            $this->products->setUpdatedStock($attribute->product_id, ($attribute->product->stock - $attribute->quantity));
            $this->basket->setDelete($attribute->basket_id);
        }

        return;
    }

    public function setUpdated($field, $attributes)
    {
        // TODO: Implement setUpdated() method.
    }

}
