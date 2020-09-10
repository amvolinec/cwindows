<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class State extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "class", "color"];

    protected static $logAttributes = [
        "name", "class", "color"
    ];
}
