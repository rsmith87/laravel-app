<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Client extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->nullable();          
            $table->longText('prefix')->nullable();
            $table->longText('first_name')->nullable();
            $table->longText('last_name')->nullable();
            $table->longText('company')->nullable();
            $table->longText('company_title')->nullable();
            $table->integer('legal_case_id')->unsigned();
            $table->integer('firm_id')->unsigned();  
            $table->integer('owner_user_id')->unsigned();
            $table->integer('client_user_id')->nullable();
            $table->foreign('legal_case_id')->references('id')->on('legal_case');
            $table->foreign('firm_id')->references('id')->on('firm');
            $table->foreign('owner_user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('client_contact_info', function (Blueprint $table){
            $table->longText('phone')->nullable();
            $table->longText('email')->nullable();
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->longText('city')->nullable();
            $table->longText('state')->nullable();
            $table->longText('zip')->nullable();
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('client');
        });

        Schema::create('client_user', function (Blueprint $table){
            $table->integer('client_user_id')->unsigned();
            $table->foreign('client_user_id')->references('id')->on('users');           
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('client');           
        });

          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_user');
        Schema::dropIfExists('client_contact_info');
        Schema::dropIfExists('client');
    }
}
