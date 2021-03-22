<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admission_id');
            $table->foreign('admission_id')->references('id')->on('admissions');
            $table->string('student_name');
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->unsignedInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->unsignedInteger('academic_id');
            $table->foreign('academic_id')->references('id')->on('academic_years');
            $table->string('regi_no');
            $table->string('roll_no');
            $table->boolean('status')->default(1);
            $table->boolean('is_promoted')->default(0);
            $table->string('old_registration_id')->nullable();
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('admins');
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
        Schema::dropIfExists('students');
    }
}
