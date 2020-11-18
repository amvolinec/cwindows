<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductNumber extends Model
{
    protected $fillable = ["id", "name", "contract_id"];


    public function contract(){
        return $this->belongsTo('App\Contract');
    }
}
