<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configuration extends Model{
    use HasFactory;

    public $primaryKey = 'name';

    public $incrementing = false;

    public $fillable = [
        'name',
        'value',
    ];

    public static function get_all(){
        $dict = [];
        foreach(self::get() as $c){
            $dict[$c->name] = $c->value;
        }
        return (object) $dict;
    }

    public static function get_locales(){
        return DB::table('locales')->get();
    }
}
