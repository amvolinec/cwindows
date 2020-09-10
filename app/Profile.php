<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Profile extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "price", "index", "file_name"];

    protected static $logAttributes = [
        "name", "price", "index", "file_name"
    ];
}
