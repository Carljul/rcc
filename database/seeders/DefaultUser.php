<?php

namespace Database\Seeders;

Use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('092322'),
            'role'              => 1,
            'isActive'          => 1,
            'created_at'        => now()
        ]);

        User::create([
            'name'              => 'Staff',
            'email'             => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('082822'),
            'role'              => 2,
            'isActive'          => 1,
            'created_at'        => now()
        ]);
    }
}
