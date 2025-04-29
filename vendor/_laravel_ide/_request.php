<?php

namespace Illuminate\Http;

interface Request
{
    /**
     * @return \App\Models\User\User|null
     */
    public function user($guard = null);
}