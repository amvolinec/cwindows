<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Architect extends Model
{
    use LogsActivity;

    protected $fillable = ["title", "phone", "email", "company", "notes"];

    protected static $logAttributes = ["title", "phone", "email", "company", "notes"];

    public function offers() {
        return $this->hasMany('App\Offer');
    }
}
