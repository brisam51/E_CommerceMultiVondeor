<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBankDatails;

class vendorBankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankVendorDatials=[
            'id'=>1,
            'vendor_id'=>1,
            'account_holder_name'=>'melat',
            'bank_name'=>'melat',
            'bank_ifsc_code'=>'1111',
            'bank_account_number'=>'1234567890',
           
        ];
        VendorBankDatails::insert($bankVendorDatials);
    }
}
