<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ["title", "client_id", "architect_id", "enquiry_date", "pv", "area", "positions", "profile", "state_id", "state_comment", "info", "enquiry_channel", "klaes", "contract_date", "contract_nr", "price_1_date", "price_1", "price_2_date", "price_2", "price_3_date", "price_3", "total", "total_with_vat", "balance", "other_services", "sales_profit", "project_amount", "project_amount_with_vat", "user_id"];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function architect()
    {
        return $this->belongsTo('App\Architect');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
