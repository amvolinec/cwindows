<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Manufacturer extends Model
{
    use LogsActivity;

    protected static $logAttributes = [
        'code', 'name'
    ];
}
