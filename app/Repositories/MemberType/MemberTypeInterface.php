<?php

namespace App\Repositories\MemberType;

interface MemberTypeInterface
{

    public function all();

    public function store($data);

    public function show($id);

    public function update($data, $id);

    public function delete($id);

}
