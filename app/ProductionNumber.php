<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  ProductionNumber extends Model
{
    protected $fillable = ["id", "name", "contract_id"];


    public function contract(){
        return $this->belongsTo('App\Contract');
    }
}
