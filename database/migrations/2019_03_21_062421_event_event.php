<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_event', function (Blueprint $table){
            $table->increments('id');
            $table->uuid('uuid')->nullable();   
            $table->text('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('events_connector', function (Blueprint $table){
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events_event');
            $table->integer('case_id')->unsigned();
            $table->foreign('case_id')->references('id')->on('legal_case');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('client');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_connector');
        Schema::dropIfExists('events_event');
    }
}
