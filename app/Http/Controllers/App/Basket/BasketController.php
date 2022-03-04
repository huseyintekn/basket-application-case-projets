<?php

namespace App\Http\Controllers\App\Basket;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repository\App\Product\ProductRepository;
use App\Repository\App\Basket\BasketRepository;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    protected $baskets;
    protected $products;

    public function __construct(BasketRepository $baskets, ProductRepository $products)
    {
        $this->baskets = $baskets;
        $this->products = $products;
    }

    public function index()
    {
        $data['baskets'] = $this->baskets->getByFields(['custemers_id' => 1], ['product']);
        $data['discountRules'] = $this->baskets->discountRules();
        return view('basket.list', $data);
    }

    public function store(Request $request)
    {
        $product = $this->products->getFind($request->input('product_id'));
        if(!$this->products->stockControl($product->stock))
        {
            return response()->json([
                'notification' => 'Ürün Stokta Bulunmamaktadır.',
                'attributes' => null,
            ]);
        }

        $basket = $this->baskets->getByField([ 'custemers_id' => 1,'product_id' => $request->input('product_id'), 'category_id' => $request->input('category_id')]);
        if (isset($basket))
        {
            if ($product->stock < $request->input('quantity') || $product->stock < ($basket->quantity + $request->input('quantity')))
            {
                return response()->json([
                    'notification' => 'Bu üründen en fazla '.$product->stock.' adet sipariş verebilirsiniz',
                    'attributes' => null,
                ]);
            }
            $newQuantity = $request->input('quantity') + $basket->quantity;
            $this->baskets->setUpdated($request->input('product_id'), $newQuantity);
        }
        else
        {
            $this->baskets->setCreate($request->input(), $request->input('product_id'));
        }

        $baskets = $this->baskets->getByFields(['custemers_id' => 1], ['product']);
        $total = $this->baskets->discountRules();
        return response()->json([
            "notification" => 'Ürün Sepete Eklendi.',
            "attributes" => $baskets,
            'total' => $total
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = $this->products->getFind($request->input('product_id'));
        if ($product->stock < $request->input('quantity')){
            return response()->json([
                'notification' => 'Bu üründen en fazla '.$product->stock.' adet sipariş verebilirsiniz',
            ]);
        }

        $this->baskets->setUpdated($id, $request->input('quantity'));
        $total = $this->baskets->discountRules();
        return response()->json([
            'total' => $total,
            'quantity' => $request->input('quantity'),
            'notification' => 'Güncelleme işlemi başarılı',
        ]);
    }

    public function destroy($id)
    {
        $this->baskets->setDelete($id);
        $total = $this->baskets->discountRules();
        return response()->json([
            'message' => 'success',
            'total' => $total,
        ]);
    }
}
