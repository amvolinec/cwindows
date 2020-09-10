<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "contact", "phone", "email", "city", "company_id"];

    protected static $logAttributes = ["name", "contact", "phone", "email", "city", "company_id"];

	public function company() {
	    return $this->belongsTo('App\Company');
    }
}
