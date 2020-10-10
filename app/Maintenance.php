<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Maintenance extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "phone", "email", "address", "comments", "notes", "setting_id"];

    protected static $logAttributes = ["name", "phone", "email", "address", "comments", "notes","setting_id"];

    public function offers() {
        return $this->hasMany('App\Offer');
    }
    public function setting(){
        return $this->belongsTo('App\Setting');
    }
}
