<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Maintenance extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "phone", "email", "address", "comments"];

    protected static $logAttributes = [
        "name", "phone", "email", "address", "comments"
    ];
}
