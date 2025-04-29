<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyContact extends Model
{
    use HasFactory;

    protected $table = 'item_contacts'; 
    
    protected $fillable = [
        'item_id',
        'agent_id',
        'name',
        'email', 
        'phone',
        'message'
    ];

    public function property()
    {
        return $this->belongsTo(\App\Models\Item\Item::class, 'item_id');
    }

    public function agent()
    {
        return $this->belongsTo(\App\Models\User\User::class, 'agent_id');
    }
}