<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "phone", "email", "address", "code", "account", "vat_code", "notes"];

    protected static $logAttributes = ["name", "phone", "email", "address", "code", "account", "vat_code", "notes"];

    public function offers() {
        return $this->hasMany('App\Offer');
    }

    public function clients() {
        return $this->hasMany('App\Client');
    }

}
