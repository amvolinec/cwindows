<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = ["name"];

    public function contract(){
        return $this->belongsTo('App\Contract');
    }
}
