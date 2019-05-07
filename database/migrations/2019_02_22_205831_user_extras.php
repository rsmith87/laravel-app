<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();
            $table->text('profile_image')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('firm_id')->unsigned()->nullable();
            $table->foreign('firm_id')->references('id')->on('firm');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('user_location', function (Blueprint $table) {
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip')->nullable();
            $table->text('timezone')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('user_law_info', function (Blueprint $table) {  
            $table->longText('state_of_bar')->nullable();
            $table->longText('bar_number')->nullable();
            $table->longText('practice_areas')->nullable();
            $table->text('education')->nullable();
            $table->text('experience')->nullable();
            $table->text('focus')->nullable();
            $table->text('title')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('user_social_media', function (Blueprint $table) {  
            $table->text('fb')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('avvo')->nullable();
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
        Schema::dropIfExists('user_settings');
        Schema::dropIfExists('user_location');
        Schema::dropIfExists('user_law_info');
        Schema::dropIfExists('user_social_media');
    }
}
