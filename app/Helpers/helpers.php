<?php
use Illuminate\Support\Str;

if (!function_exists('limit_text')) {
    function limit_text($text, $limit = 100)
    {
        return Str::limit($text, $limit);
    }
}
