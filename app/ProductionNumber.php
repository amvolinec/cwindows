<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class  ProductionNumber extends Model
{
    use LogsActivity;

    protected $fillable = ["id", "name", "contract_id"];

    protected $logAttributes = ["id", "name", "contract_id"];

    public function contract(){
        return $this->belongsTo('App\Contract');
    }
}
