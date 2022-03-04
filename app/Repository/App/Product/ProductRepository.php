<?php

namespace App\Repository\App\Product;

use App\Repository\BaseRepository;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements  ProductInterfaceRepository
{
    protected $model;
    public function __construct(Product $model)
    {
        parent::__construct($model);

        $this->model = $model;
    }

    public function setCreate(array $attributes = null)
    {

    }

    public function setUpdated($field, array $attributes)
    {
        // TODO=> Implement setUpdated() method.
    }

    public function setUpdatedStock($field, $attribute)
    {
        $this->model->find($field)->update([
            'stock' => $attribute,
            'updated_at' => now()
        ]);
    }

    public function stockControl($stock)
    {
        return (!empty($stock) && $stock > 0) ? true : false;
    }

}
