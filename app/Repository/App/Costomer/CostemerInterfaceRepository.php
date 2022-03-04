<?php

namespace App\Repository\App\Costomer;

interface CostemerInterfaceRepository
{
    public function setCreate(array $attributes);

    public function setUpdated($field, array $attributes);
}
