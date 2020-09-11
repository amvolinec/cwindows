<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "code", "vat_code", "address", "phone", "account", "email"];

    protected static $logAttributes = [
        "name", "code", "vat_code", "address", "phone", "account", "email"
    ];
}
