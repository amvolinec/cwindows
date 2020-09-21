<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = ["manager_id", "address", "version", "profile_id", "wood", "color", "area", "meters", "total", "cost", "expenses", "comments", "state"];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

	//
}
