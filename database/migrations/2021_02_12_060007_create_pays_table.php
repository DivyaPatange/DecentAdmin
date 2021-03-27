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
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->unsignedInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->unsignedInteger('fee_id');
            $table->string('receipt_no')->nullable();
            $table->decimal('total_amt')->nullable();
            $table->decimal('net_amt')->nullable();
            $table->decimal('payment_amount', 20)->nullable();
            $table->decimal('discount', 20)->nullable();
            $table->date('payment_date')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('due_amount', 20)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_method_no')->nullable();
            $table->date('payment_method_date')->nullabel();
            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('admins');
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
