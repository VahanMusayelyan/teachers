<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'subject_ru', 'subject_hy', 'subject_en','school_subjects','foreign_langs','final_entrance','for_students','other','created_at','updated_at'        
    ];
}
