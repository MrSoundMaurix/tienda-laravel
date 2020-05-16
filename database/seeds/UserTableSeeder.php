<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Creando nuevo usuario   
        User::create([

            'name' => "Rene Mauricio Ipiales",
            'email' => "reneipiales120@hotmail.com",
            'phone' => "0959072238",
            'direction' => "Ibarra- Pilanqui",

            'email' => "reneipiales120@hotmail.com",
            'password' => bcrypt("12345678%%rene"),
            'admin' => true
        ]);
    }
}
