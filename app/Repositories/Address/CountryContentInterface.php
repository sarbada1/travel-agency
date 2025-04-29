<?php

namespace App\Repositories\Address;

interface CountryContentInterface
{

    public function find($id);

    public function insertData($data);

    public function update($data, $id);

    public function delete($id);

    public function getCountryById($id);

    public function allCountry();

}
