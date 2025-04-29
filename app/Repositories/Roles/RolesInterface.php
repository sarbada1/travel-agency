<?php

namespace App\Repositories\Roles;

interface RolesInterface
{

    public function index();

    public function create();

    public function store($data);

    public function show($id);

    public function edit($id);

    public function update($data, $id);

    public function destroy($id);

}
