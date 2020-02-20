<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
        	'name'=>'Admin',
        	'email'=>'admin@admin.com',
        	'password'=>Hash::make('secret'),
        ]);
    }
}
