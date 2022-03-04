<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;
class Basket extends Model
{
    use HasFactory;

    protected $table = "baskets";

    protected $primaryKey = "basket_id";

    protected $guarded = ['basket_id'];

    public function product()
    {
        return $this->hasOne(Product::class,'product_id', 'product_id');
    }

}
