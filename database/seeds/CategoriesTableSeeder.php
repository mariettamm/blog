<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Simplemente le tenemos que
        //especificar el modelo de factory
        //que queremos que ejecute
        factory(App\Category::class, 20)->create();
                //20 porque quiero que se creen
                //20 categorías
    }
}
