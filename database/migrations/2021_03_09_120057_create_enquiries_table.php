<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_no');
            $table->string('student_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('dob');
            $table->string('contact_no');
            $table->text('address');
            $table->string('last_exam_passed');
            $table->string('percentage');
            $table->string('adm_sought');
            $table->enum('is_register', ['Yes', 'No']);
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
        Schema::dropIfExists('enquiries');
    }
}
