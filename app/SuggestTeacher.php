<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuggestTeacher extends Model
{
    protected $table = 'suggest_teachers';
    protected $fillable = [
        'name', 'email', 'phone','subject','gender_male',
        'gender_female', 'exp_min', 'exp_med','exp_max','loc_proffes',
        'loc_student','loc_online','pupil','student','adult','price_min',
        'price_max','ip','created_at','updated_at'        
    ];
}
