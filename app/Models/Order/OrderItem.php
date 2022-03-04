<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "order_items";

    protected $primaryKey = "order_item_id";

    protected $guarded = ['order_item_id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'productId');
    }
}
