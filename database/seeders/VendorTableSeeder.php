<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vondare;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $vendorRecord=[
           ['id'=>1,'name'=>'jhon','address'=>'cp-112','city'=>'delhi',
           'country'=>'India','state'=>'delhi','pincode'=>'11001',
           'mobile'=>'0970000','email'=>'jhon@email.com','status'=>0]
       ];
       Vondare::insert($vendorRecord);
    }
}
