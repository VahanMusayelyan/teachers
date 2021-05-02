<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
     protected $table = 'educations';
    protected $fillable = [
        'univers_ru', 'univers_hy', 'universe_en','created_at','updated_at'        
    ];
}
