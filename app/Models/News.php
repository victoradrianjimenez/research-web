<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model{
    use HasFactory;

    public $fillable = [
        'date',
        'url',
        'author',
        'class',
        'link',
    ];

    public function descriptions(){
        return $this->hasMany(NewsDescription::class, 'news_id', 'id');
    }

}
