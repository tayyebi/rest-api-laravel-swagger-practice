<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            ['name'=>'', 'type'=>'administrator', 'phone'=>'000', 'password'=>Hash::make('***'), 'api_token'=>'123']
        );
        User::factory()
            ->count(10)
            ->create();
    }
}
