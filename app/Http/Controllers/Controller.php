<?php

namespace App\Http\Controllers;

use App\Traits\AuthorizationChecker;
use App\Traits\General;
use App\Traits\SeoTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, General, AuthorizationChecker,SeoTrait;
}
