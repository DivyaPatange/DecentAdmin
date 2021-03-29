<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->unsignedInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('parents');
            $table->string('admission_for');
            $table->string('application_no');
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
            $table->date('dob')->nullable();
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
            $table->string('gr_no')->nullable();
            $table->string('full_name_pupil')->nullable();
            $table->string('surname')->nullable();
            $table->text('postal_address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('race_caste')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('nationality')->nullable();
            $table->string('medium')->nullable();
            $table->string('rte')->nullable();
            $table->string('father_name1')->nullable();
            $table->string('f_education')->nullable();
            $table->text('f_address')->nullable();
            $table->string('f_phone_no')->nullable();
            $table->string('mother_name1')->nullable();
            $table->string('m_education')->nullable();
            $table->text('m_address')->nullable();
            $table->string('m_phone_no')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('g_occupation')->nullable();
            $table->string('g_education')->nullable();
            $table->text('g_address')->nullable();
            $table->string('g_phone_no')->nullable();
            $table->string('other_board')->nullable();
            $table->boolean('is_register');
            $table->boolean('is_allot');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
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
        Schema::dropIfExists('admissions');
    }
}
