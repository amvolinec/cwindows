<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    protected $fillable = [
        "name",
        "title",
        "description"
    ];

    public function contacts()
    {
        return $this->belongsTo('App\Contact');
    }


}
