<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'member_id',
        'name',
        'text',
        'link'
    ];

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }

}
