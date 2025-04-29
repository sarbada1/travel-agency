<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'question',
        'answer',
        'order',
    ];
}
