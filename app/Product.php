<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;

    protected $fillable = [
        "code",
        "name",
        "category_id",
        "group_id",
        "brand_id",
        "generic_id",
        "model_id",
        "product_uom_id",
        "description",
        "price",
        "has_instances",
        "has_lots",
        "has_attributes",
        "pack_size",
        "average_cost",
        "single_unit_product_code",
        "dimension_group",
        "lot_information",
        "warranty_terms",
        "is_active"
    ];

    protected static $logAttributes = [
        "code",
        "name",
        "category_id",
        "group_id",
        "brand_id",
        "generic_id",
        "model_id",
        "product_uom_id",
        "description",
        "price",
        "has_instances",
        "has_lots",
        "has_attributes",
        "pack_size",
        "average_cost",
        "single_unit_product_code",
        "dimension_group",
        "lot_information",
        "warranty_terms",
        "is_active"
    ];
}
