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
            $table->foreign('fee_id')->references('id')->on('fees');
            $table->unsignedInteger('fee_head_id');
            $table->foreign('fee_head_id')->references('id')->on('fee_heads');
            $table->string('receipt_no');
            $table->decimal('payment_amount', 20);
            $table->decimal('discount', 20);
            $table->date('payment_date');
            $table->date('due_date');
            $table->decimal('due_amount', 20);
            $table->string('payment_method')->nullable();
            $table->string('payment_method_no')->nullable();
            $table->date('payment_method_date')->nullabel();
            $table->unsignedInteger('created_by');
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
