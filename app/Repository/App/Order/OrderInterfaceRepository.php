<?php

namespace App\Repository\App\Order;

interface OrderInterfaceRepository
{
    public function setCreate($attributes);

    public function setUpdated($field, array $attributes);
}
