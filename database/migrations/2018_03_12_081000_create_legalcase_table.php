<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('legal_case', function (Blueprint $table) {
        $table->increments('id');
        $table->uuid('case_uuid')->nullable();        
        $table->text('status')->nullable(); 
        $table->text('type')->nullable();
        $table->longText('number')->nullable();
        $table->longText('name')->nullable();
        $table->longText('description')->nullable();       
        $table->longText('claim_reference_number')->nullable();
        $table->date('open_date')->nullable();
        $table->date('close_date')->nullable();
        $table->text('statute_of_limitations')->nullable();
        $table->integer('firm_id')->nullable();
        $table->integer('user_id')->nullable();
        $table->integer('client_id')->nullable();
        $table->timestamps();
        $table->softDeletes();
      });

      Schema::create('legal_case_location', function (Blueprint $table) {
        $table->longText('court_name')->nullable();
        $table->text('city')->nullable();
        $table->text('state')->nullable();
        $table->integer('case_id')->unsigned();
        $table->foreign('case_id')->references('id')->on('legal_case');
      });

      Schema::create('legal_case_invoice', function (Blueprint $table) {
        $table->increments('id');
        $table->text('description');
        $table->integer('case_id')->unsigned();
        $table->foreign('case_id')->references('id')->on('legal_case');
      });

      Schema::create('legal_case_invoice_lines', function (Blueprint $table) {
        $table->text('description');
        $table->float('amount');
        $table->integer('invoice_id')->unsigned();
        $table->foreign('invoice_id')->references('id')->on('legal_case_invoice');
      });

      Schema::create('legal_case_billing', function (Blueprint $table) {
        $table->integer('is_billable')->nullable();
        $table->text('billing_type')->nullable();
        $table->text('billing_rate', 4, 2)->nullable();
        $table->integer('case_id')->unsigned();
        $table->foreign('case_id')->references('id')->on('legal_case');
      });

      Schema::create('legal_case_opposing_councel', function (Blueprint $table) {
        $table->text('opposing_councel_name')->nullable();
        $table->text('opposing_councel_phone')->nullable();
        $table->text('opposing_councel_fax')->nullable();
        $table->text('opposing_councel_address')->nullable();
        $table->text('opposing_councel_city')->nullable();
        $table->text('opposing_councel_state')->nullable();
        $table->text('opposing_councel_zip')->nullable();
        $table->integer('case_id')->unsigned();
        $table->foreign('case_id')->references('id')->on('legal_case');
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legal_case_invoice_lines');
        Schema::dropifExists('legal_case_invoice');
        Schema::dropIfExists('legal_case_location');
        Schema::dropIfExists('legal_case_opposing_councel');
        Schema::dropIfExists('legal_case_billing');
        Schema::dropIfExists('legal_case');
    }
}
