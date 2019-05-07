<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Firm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->text('name');
            $table->mediumText('logo')->nullable();
            $table->text('phone')->nullable();
            $table->text('fax')->nullable();
            $table->text('email')->nullable();
            $table->timestamps();
            $table->softDeletes();
          });

          Schema::create('firm_location', function (Blueprint $table) {
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip')->nullable();
            $table->integer('firm_id')->unsigned();
            $table->foreign('firm_id')->references('id')->on('firm');
        });

        Schema::create('firm_billing', function (Blueprint $table) {
            $table->integer('firm_id')->unsigned();
            $table->foreign('firm_id')->references('id')->on('firm');
            $table->text('firm_stripe_token');
            $table->mediumText('billing_details')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firm_location');
        Schema::dropIfExists('firm_billing');
        Schema::dropIfExists('firm');
    }
}
