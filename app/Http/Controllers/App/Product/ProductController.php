<?php

namespace App\Http\Controllers\App\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repository\App\Product\ProductRepository;

class ProductController extends Controller
{
    protected $products;

    public function __construct(ProductRepository $products)
    {
       $this->products = $products;
    }

    public function index()
    {
        $data['products'] = $this->products->getAll();
        return view('product.list', $data);
    }

    public function modal($id)
    {
        $data['product'] = $this->products->getByField(['product_id' => $id]);
        return view('product.add', $data);
    }
}
