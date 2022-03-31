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

        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->text('name');
            $table->text('type')->nullable();
            $table->text('path')->nullable();
            $table->longText('data')->nullable();
            $table->integer('is_folder')->default('0');
            $table->uuid('folder_uuid')->nullable();
            $table->integer('sort_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('documents_folders_model_connector', function (Blueprint $table) {
            $table->increments('id');
            $table->text('model_type');
            $table->integer('model_id');
            $table->integer('document_id')->nullable()->unsigned();
            $table->foreign('document_id')->references('id')->on('documents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_folders_model_connector');
        Schema::dropIfExists('documents');
    }
}
