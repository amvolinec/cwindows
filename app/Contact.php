<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        "name",
        "code",
        "phone",
        "address",
        "email",
        "city",
        "comment",
        "firm_id",
        "contact_type_id"
    ];


    public function firm()
    {
        return $this->belongsTo('App\Firm');
    }

    public function contact_type()
    {
        return $this->belongsTo('App\ContactType');
    }


}


