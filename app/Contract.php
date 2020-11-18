<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        "id",
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
        "periods",
        "production_start",
        "production_end",
        "production_number",
        "installation_start",
        "installation_end",
        "installation_note",
    ];

    public static function create(array $all)
    {
    }


    public function client(){
        return $this->belongsTo('App\Client');
    }


    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function maintenance(){
        return $this->belongsTo('App\Maintenance');
    }
    public function offer(){
        return $this->belongsTo('App\Offer');
    }

    public function product_number()
    {
        return $this->hasMany('App\ProductNumber');
    }
}
