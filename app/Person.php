<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Person extends Model
{
    use LogsActivity;

    protected $table = 'persons';

	protected $fillable = ["name", "email", "phone", "company_id", "address"];

    protected static $logAttributes = [
        "name", "email", "phone", "company_id", "address"
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

	//
}
