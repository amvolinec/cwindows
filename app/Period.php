<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = ["name"];

    public function contracts(){
        return $this->hasMany('App\Contract');
    }
}
