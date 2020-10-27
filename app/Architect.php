<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Architect extends Model
{
    use LogsActivity;

    protected $fillable = ["title", "phone", "email", "company", "notes", "setting_id"];

    protected static $logAttributes = ["title", "phone", "email", "company", "notes", 'setting_id'];

    public function offers() {
        return $this->hasMany('App\Offer');
    }

    public function setting(){
        return $this->belongsTo('App\Setting');
    }
}
