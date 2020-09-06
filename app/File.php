<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ["file_name", "file_uri", "offer_id"];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }
}
