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
        factory(App\User::class, 29)->create();
        //creo 29 usuarios porque el #30 voy a ser yo:
        App\User::create([
        	'name' => 'María Martorell',
        	'email'=> 'root@root.com',
        	'password' => bcrypt('root')
        ]);
        //se puede usar este modelo para añadir usuarios
        //manualmente!! Mediante un array
    }
}
