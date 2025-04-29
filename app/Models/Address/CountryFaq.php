<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'question',
        'answer',
        'order',
    ];
}
