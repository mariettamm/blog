<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');

            //titulo & la SLUG (solo necesitamos estos)
            $table->string('name', 128); //se usa el mismo espacio porque ambos campos van a tneer el mismo número de caracteres
            $table->string('slug', 128)->unique(); //esto se hace para que se puedan usar URLs amigables
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
