<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{   
        protected $table = 'contact_us';
        protected $fillable = [
        'name', 'l_name', 'email','phone','letter','ip','created_at','updated_at'        
    ];
}
