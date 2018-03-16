<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idEvent');
            $table->unsignedInteger('idUserCreated');
            $table->text('data')->nullable();
            $table->timestamps();
            
            $table->foreign('idEvent')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
            
            $table->foreign('idUserCreated')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('logs');
    }
}
