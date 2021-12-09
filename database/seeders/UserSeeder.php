<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sellers')->truncate();
        User::create([
            'name' => 'TestUser1',
            'email'=> 'user@test.com',
            'phone'=> '01287676100',
            'password' => bcrypt(123456789),
        ]);
    }
}
