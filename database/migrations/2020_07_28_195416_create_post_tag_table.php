<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            //de posts:
            $table->integer('post_id')->unsigned(); //sirve para evitar que el id sea un número negativo 
            $table->integer('tag_id')->unsigned();

            $table->timestamps();

            //y las relaciones;
            $table->foreign('post_id')->references('id')->on('posts') 
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //relación de los tags de una entrada a los tags globales
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
