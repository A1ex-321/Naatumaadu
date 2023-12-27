<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backgroundimage extends Model
{
    use HasFactory;

    protected $table = 'backgroundimage';
    protected $fillable = [
        'image_path', 
    ];
}
