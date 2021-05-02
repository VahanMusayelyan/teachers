<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
        protected $table = 'cities';
        protected $fillable = [
        'region_id','city_ru','city_hy','city_en','created_at','updated_at'     
    ];
}
