<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $table = 'notifications';
    protected $fillable = [
        'user_id', 'suggest_id', 'response', 'created_at', 'updated_at'
    ];

}
