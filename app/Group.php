<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use LogsActivity;

    protected $fillable = [
        'code', 'name',
    ];

    protected static $logAttributes = [
        'code', 'name',
    ];
}
