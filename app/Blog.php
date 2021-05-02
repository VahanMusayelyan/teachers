<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
        protected $table = 'blogs';
        protected $fillable = [
        'title_ru','title_hy','title_en', 'description_ru','description_hy','description_en', 'img','sort','created_at','updated_at'       
    ];
}
