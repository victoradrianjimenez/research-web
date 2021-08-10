<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsClass extends Model{
    use HasFactory;

    public $timestamps = false;
    
    public $fillable = [
        'name',
        'lang',
        'text',
    ];
}
