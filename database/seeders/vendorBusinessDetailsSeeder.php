<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBisnssDatails;


class vendorBusinessDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $VendorBusinessRecorde = [
            'id' => 1,
            'vendor_id' => 1,
            'shop_name' => 'jhon electronic store',
            'shop_address' => 'delhi-street 60',
            'shop_city' => 'delhi',
            'shop_state' => 'dlhi',
            'shop_country' => 'India',
            'shop_pincode' => '10001',
            'shop_mobile' => '0961664357',
            'shop_website' => 'www.stor.com',
            'shop_email' => 'jhon@email.com',
            'address_proof' => 'Passport',
            'address_proof_image' => 'test.jpg',
            'business_license_number' => '1111',
            'gst_namber' => '1111',
            'pan_number' => '1111',
        ];
        VendorBisnssDatails::insert($VendorBusinessRecorde);
    }
}
