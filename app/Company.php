<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "phone", "email", "address", "code", "account", "vat_code"];

    protected static $logAttributes = ["name", "phone", "email", "address", "code", "account", "vat_code"];

}
