<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
        'name',
        'country',
        'about',
        'age',
        'ethnicity',
        'sexuality',
        'gender',
        'drinking',
        'smoking',
        'contact',
        'eye',
        'hair_color',
        'hair_length',
        'body_size',
        'image',

    ];
}
