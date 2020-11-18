<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "contact", "phone", "email", "city", "company_id", "notes", "setting_id"];

    protected static $logAttributes = ["name", "contact", "phone", "email", "city", "company_id", "notes", "setting_id"];

	public function company() {
	    return $this->belongsTo('App\Company');
    }

    public function offers() {
        return $this->hasMany('App\Offer');
    }

    public function setting(){
        return $this->belongsTo('App\Setting');
    }

    public function contracts() {
        return $this->hasMany('App\Contract');
}
}
