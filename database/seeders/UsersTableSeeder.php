<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::create([
            'name' => 'Md. Abul Kalam Azad', 
            'email' => 'rubelazad123@gmail.com',
            'password' => Hash::make('Admin@100%')
        ]);
    }
}
