<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

require_once __DIR__ . '/routing/frontend.php';
Auth::routes(['verify' => true]);

require_once __DIR__ . '/routing/backend.php';
