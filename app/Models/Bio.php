<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'lang',
        'role',
        'short',
        'interests',
        'activities'
    ];

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }
}
