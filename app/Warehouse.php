<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Warehouse extends Model
{
    use LogsActivity;

    protected $fillable = [
        "site_id", "code", "name"
    ];


    protected static $logAttributes = [
        "site_id", "code", "name"
    ];

}
