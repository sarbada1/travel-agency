<?php
// filepath: /home/sarbada/Desktop/booking/app/Models/Contact/Contact.php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'inquiry_type',
        'message',
        'user_id',
        'status'
    ];

    /**
     * Get the user associated with the contact.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}