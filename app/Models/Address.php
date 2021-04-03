<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "full_address",
        "federal_district",
        "region_with_type",
        "area_with_type",
        "city_with_type",
        "city_district_with_type",
        "settlement_with_type",
        "street_with_type",
        "house_type_full",
        "house"
    ];
}
