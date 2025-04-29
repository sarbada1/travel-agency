<?php

namespace App\Repositories\Address\Child;

interface CountryPageInterface
{

    public function all($pid);

    public function get($id);

    public function insert(array $data);

    public function update(array $data, $id);

    public function getChild($pageId);

    public function getAll();

    public function getAllCountry();

}
