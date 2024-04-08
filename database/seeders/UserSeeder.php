<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array (
            array(
                "name" => "Douglas Matos",
                "email" => "matos_santos@hotmail.com",
                "password" => Hash::make("123")
            )
        );

        foreach($users as $user) {
            User::create($user);
        }
    }
}
