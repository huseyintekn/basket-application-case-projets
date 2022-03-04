<?php

namespace App\Http\Controllers\App\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Repository\App\Order\OrderRepository;
use App\Repository\App\Basket\BasketRepository;
use App\Repository\App\Order\OrderItemRepository;

class OrderController extends Controller
{
    protected $orders;
    protected $orderItems;
    protected $baskets;

    public function __construct(OrderRepository $orders, OrderItemRepository $orderItems, BasketRepository $baskets)
    {
        $this->orders = $orders;
        $this->orderItems = $orderItems;
        $this->baskets = $baskets;
    }

    public function index()
    {
        $data['orders'] = $this->orders->getByFields(['customerId' => 1], ['orderItem', 'orderItem.product']);
        return view('order.list', $data);
    }

    public function store(Request $request)
    {
        $attributes = [];
        $attributes = $this->baskets->getByFields(['custemers_id' => 1], ['product']);
        $this->orders->setCreate($attributes);

        return redirect()->route('app.order.index');
    }

    public function destroy($id)
    {
        $this->orders->setDelete($id);
        $this->orderItems->delete($id);
        return redirect()->route('app.order.index');
    }
}
