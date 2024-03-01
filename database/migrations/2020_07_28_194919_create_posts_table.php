<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned(); //sirve para evitar que el id sea un número negativo 
            $table->integer('category_id')->unsigned();
            //Contenido de un post:
            // titulo & URLslug
            $table->string('name', 128); //se usa el mismo espacio porque ambos campos van a tneer el mismo número de caracteres
            $table->string('slug', 128)->unique(); //esto se hace para que se puedan usar URLs amigables
            //extracto?
            $table->mediumText('excerpt')->nullable();
            //Contenido del post
            $table->text('body');
            //Estado del post: tiene dos posibles valores, publicado o borrador
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');
            //Pongo los valores en mayús pq es un valor CONSTANTE

            //Para que el post pueda tener imágenes:
            $table->string('file', 128)->nullable();

            $table->timestamps();

            //Relaciones entre los campos de esta tabla con la tablas 
            // usuario y categoría respc

            //este método borra todos los posts de un usuario al borrarlo(valores cascada)
            $table->foreign('user_id')->references('id')->on('users') 
                    //la clave foranea id de usuario hace referencia al id de la tabla usuarios
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //este método borra todos los posts dentro de una categoría al borrarla
            $table->foreign('category_id')->references('id')->on('categories')
                //la clave foranea id de categoria hace referencia al id de la tabla categorias
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
        Schema::dropIfExists('posts');
    }
}
