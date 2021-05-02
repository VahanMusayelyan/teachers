<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactTeacher extends Model
{
    //contact_teacher
    protected $table = 'contact_teacher';
        protected $fillable = [
        'teacher_id', 'name_lname', 'phone','subject_id','resend'    
    ];
}
