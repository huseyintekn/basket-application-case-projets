<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $primaryKey = "order_id";

    protected $guarded = ['order_id'];

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class,'order_id','order_id');
    }
}
