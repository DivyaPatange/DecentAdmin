<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavingCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaving_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('allot_student_id');
            $table->foreign('allot_student_id')->references('id')->on('allotment_students');
            $table->unsignedInteger('admission_id');
            $table->foreign('admission_id')->references('id')->on('junior_admissions');
            $table->string('certificate_no');
            $table->string('general_reg_no')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('taluka')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('academic_progress')->nullable();
            $table->string('conduct')->nullable();
            $table->date('leaving_date')->nullable();
            $table->text('college_studying')->nullable();
            $table->text('leaving_reason')->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_present')->nullable();
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
        Schema::dropIfExists('leaving_certificates');
    }
}
