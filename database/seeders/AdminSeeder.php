<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        Admin::create([
            "name"=>"developer",
            "user_name"=>"@mostafa",
            "password"=>bcrypt("developer@mostafa"),
            "phone_number"=>"+201021408853",
            "email"=>"mostafa@developer.com",
        ]);
    }
}
