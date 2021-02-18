<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotment_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('allotment_id');
            $table->foreign('allotment_id')->references('id')->on('allotments');
            $table->unsignedInteger('admission_id');
            $table->foreign('admission_id')->references('id')->on('junior_admissions');
            $table->string('collage_ID');
            $table->enum('status',array('Allot', 'Promote'));
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
        Schema::dropIfExists('allotment_students');
    }
}
