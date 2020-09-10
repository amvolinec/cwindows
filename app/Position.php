<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Position extends Model
{
    use LogsActivity;

    protected $fillable = [
        "offer_id",
        "product_id",
        "warehouse_id",
        "title",
        "quantity",
        "cost",
        "price",
        "discount",
        "discount_next",
        "final_price",
        "subtotal",
        "total",
        "vat",
    ];

    protected static $logAttributes = [
        "offer_id",
        "product_id",
        "warehouse_id",
        "title",
        "quantity",
        "cost",
        "price",
        "discount",
        "discount_next",
        "final_price",
        "subtotal",
        "total",
        "vat",
    ];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }
}
