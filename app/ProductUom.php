<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductUom extends Model
{
    use LogsActivity;

    protected $fillable = [
        "name"
    ];


    protected static $logAttributes = [
        "name"
    ];
}
