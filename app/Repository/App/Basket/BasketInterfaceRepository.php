<?php

namespace App\Repository\App\Basket;

interface BasketInterfaceRepository
{
    public function setCreate(array $attributes);

    public function setUpdated($id, $attribute);

    public function discountRules();
}
