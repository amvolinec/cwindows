<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
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

    //

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }
}
