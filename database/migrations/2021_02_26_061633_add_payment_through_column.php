<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentThroughColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pays', function ($table) {
            $table->string('pay_by')->nullable();
            $table->string('pay_by_no')->nullable();
            $table->date('pay_by_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pays', function ($table) {
            $table->dropColumn('pay_by');
            $table->dropColumn('pay_by_no');
            $table->dropColumn('pay_by_date');
        });
    }
}
