<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TransactionType extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "info"];

	protected static $logAttributes = ["name", "info"];

}
