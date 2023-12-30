<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'email', 'subject', 'message'];

    // Additional model configurations or relationships can be added here if needed
}