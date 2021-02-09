<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuniorAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junior_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('admission_reg_no')->nullable();
            $table->unsignedInteger('academic_id');
            $table->foreign('academic_id')->references('id')->on('academic_years');
            $table->date('admission_date')->nullable();
            $table->string('student_name')->nullable();
            $table->string('student_photo')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('f_occupation')->nullable();
            $table->string('m_occupation')->nullable();
            $table->string('mobile_no')->nullable();
            $table->text('address')->nullable();
            $table->string('adhaar_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('id_no')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('sub_caste')->nullable();
            $table->string('last_exam_passed')->nullable();
            $table->string('percentage')->nullable();
            $table->string('math_mark')->nullable();
            $table->string('science_mark')->nullable();
            $table->string('out_of')->nullable();
            $table->string('last_school_attended')->nullable();
            $table->string('board')->nullable();
            $table->string('adm_sought')->nullable();
            $table->string('stream')->nullable();
            $table->string('other_board')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('junior_admissions');
    }
}
