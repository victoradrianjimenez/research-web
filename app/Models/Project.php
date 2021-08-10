<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model{
    use HasFactory;

    public $fillable = [
        'type',
        'title',
        'logo',
        'institution',
        'code',
        'period',
        'class',
        'link',
        'url'
    ];

    public static function get_class_list(){
        return ['current', 'past'];
    }

    public function partners(){
        return $this->belongsToMany(Partner::class, 'project_partner');
    }

    public function descriptions(){
        return $this->hasMany(ProjectDescription::class, 'project_id', 'id');
    }

}
