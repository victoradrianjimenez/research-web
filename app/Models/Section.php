<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model{
    use HasFactory;

    public $fillable = [
        'url'
    ];

    public function descriptions(){
        return $this->hasMany(Description::class, 'section_id', 'id');
    }
    
    public static function get_descriptions($url, $lang, $type=null){
        $description = false;
        $section = Section::where('url','=',$url)->first();
        if ($section){
            $x = $section->descriptions()->where('lang','=',$lang);
            $description = ($type) ? $x->where('type','=',$type)->get() : $x->get();
            if (!$description){
                $x = $section->descriptions();
                $description = ($type) ? $x->where('type','=',$type)->get() : $x->get();
            }
        }
        if (!$description){
            $description = [new Description(['url'=>$url, 'lang'=>$lang, 'type'=>'section'])];
        }
        return $description;
    }

}
