<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('idnumber');
            $table->string('name');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->date('created_date')->useCurrent();
            $table->tinyInteger('status')->comment('1 = Time In AM, 2 = Time Out AM, 3 = Time In PM, 4 = Time Out PM');
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
        Schema::dropIfExists('attendances');
    }
}
