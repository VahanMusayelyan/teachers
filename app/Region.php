<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
   protected $table = 'regions';
    protected $fillable = [
        'country_id', 'region_ru', 'region_hy','region_en','created_at','updated_at'
        
    ];
}
