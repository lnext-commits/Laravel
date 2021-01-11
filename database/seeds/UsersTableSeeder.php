<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Петя',
            'surname' => 'Иванов',
            'login' => 'testMan',
            'password' => '1123'
        ]);
    }
}
