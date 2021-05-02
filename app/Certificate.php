<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';
        protected $fillable = [
        'user_id','certificate','created_at','updated_at'];
}


