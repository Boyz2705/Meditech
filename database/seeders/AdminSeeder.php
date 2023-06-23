<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Bayu Safutra",
            "email" => "syahbayu17@gmail.com",
            "username" => "bayu.safutra",
            "password" => bcrypt("123456"),
            "roleid" => true,
            "notelp" => "0881026108614",
            "gender" => true
        ]);
    }
}
