<?php

namespace App\Http\Controllers\Backend\Common;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public $backendPath = 'backend.';
    public $pagePath;

    public function __construct()
    {
        parent::__construct();
        $this->pagePath = $this->backendPath . 'pages.';
    }
}
