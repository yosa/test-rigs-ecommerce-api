<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idProduct');
            $table->unsignedInteger('idUserCreated');
            $table->smallInteger('quantity');
            $table->timestamps();
            
            $table->foreign('idProduct')
                ->references('id')
                ->on('products')
                /* only delete records in test unit */
                ->onDelete('cascade');
            $table->foreign('idUserCreated')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping');
    }
}
