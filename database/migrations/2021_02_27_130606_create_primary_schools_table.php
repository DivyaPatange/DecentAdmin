<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimarySchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_ID')->nullable();
            $table->unsignedInteger('academic_id');
            $table->foreign('academic_id')->references('id')->on('academic_years');
            $table->string('gr_no');
            $table->date('admission_date');
            $table->string('full_name_pupil');
            $table->string('surname');
            $table->string('father_name');
            $table->string('mother_name');
            $table->text('postal_address');
            $table->string('occupation')->nullable();
            $table->string('phone_no');
            $table->string('race_caste');
            $table->string('monthly_income');
            $table->date('dob');
            $table->string('birth_place');
            $table->string('nationality');
            $table->string('last_school_attended')->nullable();
            $table->string('last_exam_passed')->nullable();
            $table->string('adm_sought');
            $table->string('medium');
            $table->string('rte');
            $table->string('father_name1')->nullable();
            $table->string('f_occupation')->nullable();
            $table->string('f_education')->nullable();
            $table->text('f_address')->nullable();
            $table->string('f_phone_no')->nullable();
            $table->string('mother_name1')->nullable();
            $table->string('m_occupation')->nullable();
            $table->string('m_education')->nullable();
            $table->text('m_address')->nullable();
            $table->string('m_phone_no')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('g_occupation')->nullable();
            $table->string('g_education')->nullable();
            $table->text('g_address')->nullable();
            $table->string('g_phone_no')->nullable();
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
        Schema::dropIfExists('primary_schools');
    }
}
