<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Wilian Ponce',
            'email' => "wily2809@hotmail.com",
            'password' => Hash::make('12345678'),
        ]);
        User::factory()->times(5)->create();
    }
}
