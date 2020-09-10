<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Generic extends Model
{
    use LogsActivity;

    protected static $logAttributes = [
        'name'
    ];
}
