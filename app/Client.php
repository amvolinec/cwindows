<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ["name", "contact", "phone", "email", "city", "company_id"];

	public function company() {
	    return $this->belongsTo('App\Company');
    }
}
