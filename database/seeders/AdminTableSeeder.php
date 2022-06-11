<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create new admin seeder..
        $recordAdmin=[
            [
                'id'=>1,
                'name'=>'super Admin',
                'type'=>'superAdmin',
                'vondar_id'=>0,
                'mobile'=>'0994444444',
                'email'=>'admin@email.com',
                'password'=>'$2y$10$zqRrO4rkgg72AMNs7m/a3e9Kio8VQKm.Us6E.82L.OiATFq5yxvAu',
                'image'=>'',
                'status'=>1
            ],
            
            ];//end variable..

            Admin::insert($recordAdmin);
    }//end method..
}//end class..
