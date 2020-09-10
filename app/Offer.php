<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Offer extends Model
{

    use LogsActivity;

    protected $fillable = [
        "company_id",
        "client_id",
        "architect_id",
        "inquiry_date",
        "planed_date",
        "number",
        "order_number",
        "title",
        "pv",
        "area",
        "state_id",
        "state_comment",
        "info",
        "pipeline",
        "enquiry_channel",
        "klaes",
        "contract_date",
        "contract_nr",
        "price_1_date",
        "price_1",
        "price_2_date",
        "price_2",
        "price_3_date",
        "price_3",
        "total",
        "total_with_vat",
        "balance",
        "other_services",
        "sales_profit",
        "planned_amount_percents",
        "project_amount",
        "project_amount_with_vat",
        "user_id",
        "delivery_address",
        "delivery_date",
        "comment",
        "manager_id",
        "received_id",
        "private",
        "description",
        "type_id",
        "profile_id",
        "maintenance_id",
        "partner",
    ];

    protected static $logAttributes = [
        "company_id",
        "client_id",
        "architect_id",
        "inquiry_date",
        "planed_date",
        "number",
        "order_number",
        "title",
        "pv",
        "area",
        "state_id",
        "state_comment",
        "info",
        "pipeline",
        "enquiry_channel",
        "klaes",
        "contract_date",
        "contract_nr",
        "price_1_date",
        "price_1",
        "price_2_date",
        "price_2",
        "price_3_date",
        "price_3",
        "total",
        "total_with_vat",
        "balance",
        "other_services",
        "sales_profit",
        "planned_amount_percents",
        "project_amount",
        "project_amount_with_vat",
        "user_id",
        "delivery_address",
        "delivery_date",
        "comment",
        "manager_id",
        "received_id",
        "private",
        "description",
        "type_id",
        "profile_id",
        "maintenance_id",
        "partner",
    ];

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

    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function positions()
    {
        return $this->hasMany('App\Position');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function setInquiryDateAttribute($value){
        $this->attributes['inquiry_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setPlanedDateAttribute($value){
        $this->attributes['planed_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setContractDateAttribute($value)
    {
        $this->attributes['contract_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setPrice1DateAttribute($value)
    {
        $this->attributes['price_1_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setPrice2DateAttribute($value)
    {
        $this->attributes['price_2_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setPrice3DateAttribute($value)
    {
        $this->attributes['price_3_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = empty($value) ? null : substr($value, 0, 10);
    }
}
