<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Generator\RandomBytesGenerator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
        	'name'=>'Miguel sapalalo',
        	'email'=>'miguelsapalomiguel17@gmail.com',
        	'password'=>Hash::make('tchiyovo'),
            'tipo'=>'Administrador',
            'matricula'=>rand(1,10),
            'foto'=>'default.jpg'


        	]);
    }
}
