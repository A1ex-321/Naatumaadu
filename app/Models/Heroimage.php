<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heroimage extends Model
{
    use HasFactory;

    protected $table = 'herogroundimage';
    protected $fillable = [
        'image_path', 
    ];
}
