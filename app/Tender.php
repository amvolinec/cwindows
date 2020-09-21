<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = ["manager_id", "delivery_address", "version", "profile_id", "materials", "colors", "squaring", "meters", "total_with_vat", "cost", "expenses", "comments", "state", "offer_id", "total"];

    public function managers()
    {
        return $this->belongsTo('App\User');
    }


    public function profiles()
    {
        return $this->belongsTo('App\Profile');
    }


    public function offers()
    {
        return $this->belongsTo('App\Offer');
    }

	//
}
