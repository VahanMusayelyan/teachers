<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
        protected $table = 'comments';
        protected $fillable = [
        'teacher_id', 'subject_id', 'name','l_name','avg_value','comment','ip','preview','created_at','updated_at'        
    ];
}
