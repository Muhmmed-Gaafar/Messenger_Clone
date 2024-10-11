<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'owner_id',
        'image',
        'is_private',
        'is_active',
        'user_id',
    ];
}
