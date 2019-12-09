<?php

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
        DB::table('users')->insert([
        	'name' => 'Miguel Huerta',
        	'email' => 'guelme88@gmail.com',
        	'password' => Hash::make('test1234')
        ]);

        DB::table('users')->insert([
        	'name' => 'John Doe',
        	'email' => 'jdoe@gmail.com',
        	'password' => Hash::make('test1234')
        ]);
    }
}
