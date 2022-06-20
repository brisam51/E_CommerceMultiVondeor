<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBisnssDatails extends Model
{
    use HasFactory;
    protected $table = 'vendors_businss_details';
    protected $fillable = [
        'shop_name',
        'shop_address',
        'shop_city',
        'shop_country',
        'shop_state',
        'shop_pincode',
        'shop_mobile',
        'shop_website',
        'shop_email',
        'address_proof',
        //'address_proof_image',
        'business_license_number',
        'gst_namber',
        'pan_number'
        
    ];
}
