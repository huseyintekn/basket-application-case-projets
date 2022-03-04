<?php

namespace App\Repository\App\Basket;

use App\Repository\App\Product\ProductRepository;
use App\Repository\BaseRepository;
use App\Models\Basket\Basket;
use Illuminate\Support\Facades\DB;

class BasketRepository extends BaseRepository implements BasketInterfaceRepository
{
    protected $model;
    protected $products;

    public function __construct(Basket $model, ProductRepository  $products)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->products = $products;
    }

    public function setCreate(array $attributes)
    {
       $this->model->create([
          'product_id' => $attributes['product_id'],
          'category_id' => $attributes['category_id'],
          'custemers_id' => 1,
          'quantity' => $attributes['quantity'],
       ]);

       return;
    }

    public function setUpdated($id, $attribute)
    {
        $this->model->where('product_id', $id)->update([
            'quantity' =>$attribute
        ]);

        return;
    }

    public function discountRules()
    {
        $discountFile = vars('discount');

        $data['discounts'] = [];
        $data['totalDiscount'] = 0;
        $data['discountedTotal'] = 0;

        $data['totalQuantity'] = $this->getByFields(['custemers_id'=>1])->sum('quantity');

        $data['totalPrice'] = DB::table('baskets')->where(['custemers_id'=>1])
            ->join('products', 'products.product_id', '=', 'baskets.product_id')
            ->sum(DB::raw('products.price * baskets.quantity'));

        settype($data['totalPrice'], 'integer');

        if ($data['totalPrice'] >= $discountFile->totalDiscount->condition)
        {
            $data['discountedTotal'] -= ($data['totalPrice'] * $discountFile->totalDiscount->percent) / 100;
            $data['totalDiscount'] += ($data['totalPrice'] * $discountFile->totalDiscount->percent) / 100;

            $answer['discountReason'] = $discountFile->totalDiscount->discountReason;
            $answer['discountAmount'] = ($data['totalPrice'] * $discountFile->totalDiscount->percent) / 100;
            $answer['subtotal'] = $data['discountedTotal'] - ($data['totalPrice'] * $discountFile->totalDiscount->percent) / 100;

            $data['discounts'][] = $answer;

        }

        $basketAll = DB::table('baskets')->selectRaw('baskets.*')->groupBy('category_id')->havingRaw('count(category_id) > 0')->get();

        foreach ($basketAll as $basket)
        {
            $dicountCategoryCondition = $this->getByFields(['custemers_id'=>1, 'category_id' => $basket->category_id])->sum('quantity');
            if ($discountFile->categoryBasedOne->category_id == $basket->category_id && $discountFile->categoryBasedOne->condition <= $dicountCategoryCondition)
            {
                $product = $this->products->getByField(['product_id' => $basket->product_id, 'category_id' => $discountFile->categoryBasedOne->category_id]);

                $data['discountedTotal'] = ($data['totalPrice'] - $product->price);
                $data['totalDiscount'] += $product->price;

                $answerFirst['discountReason']  = $discountFile->categoryBasedOne->discountReason;
                $answerFirst['discountAmount'] =  $product->price;
                $answerFirst['subtotal'] = $data['totalPrice'] - $product->price;

                $data['discounts'][] = $answerFirst;

            }
            if ($discountFile->categoryBasedTwo->category_id == $basket->category_id && $discountFile->categoryBasedTwo->condition <= $dicountCategoryCondition)
            {
                $productCategoryMinPrice = $this->getByFields(['baskets.custemers_id'=>1, 'category_id' => $discountFile->categoryBasedTwo->category_id],['product'])->min('product.price');

                $data['discountedTotal'] = ($data['totalPrice'] - (($productCategoryMinPrice * $discountFile->categoryBasedTwo->percent) / 100));
                $data['totalDiscount'] += (($productCategoryMinPrice * $discountFile->categoryBasedTwo->percent) / 100);

                $answerSecond['discountReason'] = $discountFile->categoryBasedTwo->discountReason;
                $answerSecond['discountAmount'] = (($productCategoryMinPrice * $discountFile->categoryBasedTwo->percent) / 100);
                $answerSecond['subtotal'] =  ($data['totalPrice'] - (($productCategoryMinPrice * $discountFile->categoryBasedTwo->percent) / 100));

                $data['discounts'][] = $answerSecond;
            }
        }

        return $data;
    }

    public function toArray()
    {
        return $this->model->getByFields(['custemers_id' => 1], ['product'])->toArray();
    }

}
