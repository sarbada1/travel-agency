<?php

namespace App\Repositories\Address;

interface CountryInterface
{

    public function all();

    public function find($id);

    public function create($data);

    public function update($data, $id);

    public function delete($id);

    public function getAllContinent($id = "");

    public function addLocation($data,$countryId);

    public function deleteDataLocation($id);

    public function updateLocation($data, $id);

    public function findLocationData($id);

}
