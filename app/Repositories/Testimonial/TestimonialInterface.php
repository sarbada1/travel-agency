<?php

namespace App\Repositories\Testimonial;

interface TestimonialInterface
{

    public function all();

    public function get($id);

    public function insert(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
