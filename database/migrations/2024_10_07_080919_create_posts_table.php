<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //usuario crea post
            $table->foreign('user_id')->references('id')->on('users');
            // recordemos que en estas dos linea creamos el campo que conectara 
            // con la tabla usuarios y a continuación indicamos que dicho campo
            // referencia el id en la tabla users
            $table->unsignedBigInteger('category_id'); //usuario crea post
            $table->foreign('category_id')->references('id')->on('users');


            $table->string('title');
            $table->string('slug'); // identificador al final de la ulr, han de ser unicos
            $table->text('body');
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('posts')){
            Schema::table('posts', function (Blueprint $table) {
                $table->dropForeign('posts_dealer_id_foreign'); //this is the line
                $table->dropIndex('posts_dealer_id_index');
                $table->dropColumn('dealer_id');
            });
        }
        Schema::dropIfExists('posts'); 

        
    }
};
