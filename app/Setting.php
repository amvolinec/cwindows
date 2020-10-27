<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "code", "vat_code", "address", "phone", "account", "email",  "web", "file_name", "file_uri", "currency_id"];

    protected static $logAttributes = [
        "name", "code", "vat_code", "address", "phone", "account", "email",  "web", "file_name", "file_uri", "currency_id"
    ];

    public function currency(){
        return $this->belongsTo('App\Currency');
    }
}
