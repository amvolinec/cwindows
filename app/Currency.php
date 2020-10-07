<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Currency extends Model
{
    use LogsActivity;

    protected $fillable = [
        "country", "currency", "code", "symbol"
    ];

    protected static $logAttributes = [
        "country", "currency", "code", "symbol"
    ];
}
