<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ["name", "phone", "email", "address", "code", "account", "vat_code"];

	//
}