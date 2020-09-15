<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use LogsActivity;

    protected $states = [
        ['id' => 0, 'name' => 'not selected'],
        ['id' => 1, 'name' => 'registered'],
        ['id' => 2, 'name' => 'in progress'],
        ['id' => 3, 'name' => 'completed'],
    ];

    protected $fillable = ["completed_at", "state_id", "costs", "income", "pay_id", "warranty", "notes", "list_of_orders", "executor", "offer_id", "manager_id"];

    protected static $logAttributes = [
        "completed_at", "state_id", "costs", "income", "pay_id", "warranty", "notes", "list_of_orders", "executor", "offer_id", "manager_id"
    ];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }


    public function manager()
    {
        return $this->belongsTo('App\User');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function states(){
        return $this->states;
    }

    public function getStateAttribute() {
        return $this->states[(int)$this->state_id];
    }
}
