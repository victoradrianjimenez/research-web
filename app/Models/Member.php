<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model{
    use HasFactory;

    protected $fillable = [
        'url',
        'type',
        'fullname',
        'photo',
        'order'
    ];

    public function bios(){
        return $this->hasMany(Bio::class, 'member_id', 'id');
    }

    public function socials(){
        return $this->hasMany(Social::class, 'member_id', 'id');
    }

    public function publications(){
        return $this->belongsToMany(Publication::class, 'publication_member');
    }

    public static function get_type_list(){
        return ['senior','researcher','external','support','alumni','past'];
    }

    public static function get_social_list(){
        return [
            'mail',
            'phone',
            'website',
            'calendly',
            'bitbucket',
            'github',
            'researchgate',
            'scholar',
            'orcid',
            'publons',
            'mendeley',
            'zotero',
            'linkedin',
            'facebook',
            'instagram',
            'whatsapp'
        ];
    }
}
