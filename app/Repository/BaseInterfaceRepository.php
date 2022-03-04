<?php

namespace App\Repository;

interface BaseInterfaceRepository
{
    public function getAll(array $relationships = []);

    public function getFind($id, array $relationships = []);

    public function getByField(array $fields, array $relationships = []);

    public function getByFields(array $fields, array $relationships = []);

    public function getToArray(array $fields, $column, array $relationships = []);

    public function setDelete($id);

}
