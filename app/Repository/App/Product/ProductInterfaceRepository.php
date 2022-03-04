<?php

namespace App\Repository\App\Product;

interface ProductInterfaceRepository
{
    public function setCreate(array $attributes);

    public function setUpdated($field, array $attributes);

    public function setUpdatedStock($field, $attribute);

    public function stockControl($stock);
}
