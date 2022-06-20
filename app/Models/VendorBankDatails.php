<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBankDatails extends Model
{
    use HasFactory;
    protected $table='vendor_bank_details';
    protected $fillable=[
        'bank_name',
        'account_holder_name',
        'bank_ifsc_code',
        'bank_account_number',
    ];
}
