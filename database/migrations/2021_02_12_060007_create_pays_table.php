<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admission_id');
            $table->foreign('admission_id')->references('id')->on('junior_admissions');
            $table->unsignedInteger('fee_id');
            $table->foreign('fee_id')->references('id')->on('fees');
            $table->string('receipt_no');
            $table->string('payment_amount');
            $table->date('payment_date');
            $table->date('due_date');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('pays');
    }
}
