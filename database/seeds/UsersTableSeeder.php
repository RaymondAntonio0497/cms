<?php

use Illuminate\Database\Seeder;
use App\User;
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
        $user = User::where('email', 'blackyblake@gmail.com')->first();

        if(!$user)
        {
            User::create([
                'name' => 'Laurencius Raymond',
                'email' => 'blackyblake@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
