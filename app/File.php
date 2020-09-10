<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    use LogsActivity;

    protected $fillable = ["file_name", "file_uri", "offer_id"];

    protected static $logAttributes = [
        "file_name", "file_uri", "offer_id"
    ];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }
}
