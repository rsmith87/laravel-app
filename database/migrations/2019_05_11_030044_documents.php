<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Documents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->text('name');
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->text('name');
            $table->text('type');
            $table->text('path');
            $table->longText('data');
            $table->integer('sort_id');
            $table->integer('folder_id')->unsigned();
            $table->foreign('folder_id')->references('id')->on('folders');
            $table->integer('folder_sort_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
        Schema::dropIfExists('documents');
    }
}
