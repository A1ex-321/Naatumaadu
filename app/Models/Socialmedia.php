<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    use HasFactory;

    protected $table = 'socialmedia';
    protected $fillable = [
        'facebook','instagram','twitter','mail','google','videolink' 
    ];
}
