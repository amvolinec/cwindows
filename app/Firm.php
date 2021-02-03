<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    protected $fillable = [
        "code",
        "vat_code",
        "account",
        "name",
        "phone",
        "address",
        "email",
        "city",
        "comment"
    ];


    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}
