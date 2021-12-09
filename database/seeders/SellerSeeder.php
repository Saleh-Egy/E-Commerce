<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sellers')->truncate();
        Seller::create([
            'name' => 'TestSeller1',
            'email'=> 'seller@test.com',
            'phone'=> '01287676108',
            'password' => bcrypt(123456789),
        ]);
    }
}
