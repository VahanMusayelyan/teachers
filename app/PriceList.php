<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{   
    protected $table = 'price_lists';
    protected $fillable = [
        'user_id', 'subject_id', 'location_user','location_student','location_online',
        'price_user', 'price_student', 'price_online','duration_user','duration_student',
        'duration_online','pupil','student','adult','created_at','updated_at'
        
    ];
}
