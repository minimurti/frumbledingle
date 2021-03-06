<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //$table->softDeletes();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('location_id');
            $table->foreign('location_id')
            ->references('id')->on('locations')
            ->onDelete('cascade');
            
            
            $table->integer('category_id');
            $table->foreign('category_id')
      ->references('id')->on('categories')
      ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
