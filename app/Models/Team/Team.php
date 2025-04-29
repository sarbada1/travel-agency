<?php

namespace App\Models\Team;

use App\Models\MemberType\MemberType;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;


    protected $fillable = [
        'member_type_id',
        'user_id',
        'name',
        'slug',
        'email',
        'image',
        'gender',
        'phone',
        'country',
        'address',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'github',
        'youtube',
        'website',
        'birthday',
        'description',

    ];


    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
