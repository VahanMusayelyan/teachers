<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'country_ru', 'country_hy', 'country_en','created_at','updated_at'
        
    ];
}
