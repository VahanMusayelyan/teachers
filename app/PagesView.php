<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagesView extends Model {

    protected $table = 'pages_views';
    protected $fillable = [
        'ip', 'user_id', 'view_date'
    ];

}
