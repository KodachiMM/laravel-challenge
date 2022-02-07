<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id');
            $table->string('month');
            $table->string('year');
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('deduction', 12, 2)->default(0);
            $table->decimal('bonus', 12, 2)->default(0);
            $table->timestamps();
            $table->unique(['staff_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
