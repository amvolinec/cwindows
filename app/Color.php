<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Color extends Model
{
    use LogsActivity;

    protected $fillable = ["name", "code", "file_name", "file_uri"];

    protected static $logAttributes = [
        "name", "code", "file_name", "file_uri"
    ];

    public function offers(){
        return $this->hasMany('App\Offer');
    }
}
