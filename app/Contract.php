<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Contract extends Model
{
    use LogsActivity;

    protected $fillable = [
        "offer_id",
        "signed_at",
        "planed_at",
        "finished_at",
        "warranted_at",
        "client_id",
        "company_id",
        "manager_id",
        "address",
        "amount",
        "payments",
        "maintenance_id",
        "expenses",
        "margin",
        "period_id",
        "production_start",
        "production_end",
        "installation_start",
        "installation_end",
        "installation_note",
    ];

    protected $logAttributes = [
        "offer_id",
        "signed_at",
        "planed_at",
        "finished_at",
        "warranted_at",
        "client_id",
        "company_id",
        "manager_id",
        "address",
        "amount",
        "payments",
        "maintenance_id",
        "expenses",
        "margin",
        "period_id",
        "production_start",
        "production_end",
        "installation_start",
        "installation_end",
        "installation_note",
    ];

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function manager(){
        return $this->belongsTo('App\User');
    }

    public function maintenance(){
        return $this->belongsTo('App\Maintenance');
    }
    public function offer(){
        return $this->belongsTo('App\Offer');
    }

    public function period(){
        return $this->belongsTo('App\Period');
    }

    public function production_number()
    {
        return $this->hasMany('App\ProductionNumber');
    }
}
