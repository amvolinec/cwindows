<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use LogsActivity;

    protected $fillable = ["amount", "number", "state_id", "transaction_type_id", "info", "details", "offer_id", "date"];

    protected static $states = [
        ['id' => 1, 'name' => 'In progress'],
        ['id' => 2, 'name' => 'Approved'],
        ['id' => 3, 'name' => 'Rejected']
    ];

    protected static $logAttributes = [
        "amount", "number", "state_id", "transaction_type_id", "info", "details", "offer_id", "date"
    ];

    public function transaction_type()
    {
        return $this->belongsTo('App\TransactionType');
    }

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    public function getStateAttribute() {
        return self::$states[$this->state_id]['name'];
    }

    public static function states() {
        return self::$states;
    }
}
