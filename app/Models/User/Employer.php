<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_slug',
        'company_description',
        'company_address',
        'company_phone',
        'company_email',
        'company_logo',
        'register_date',
        'company_website',
        'status',
        'approved_at',
    ];

}
