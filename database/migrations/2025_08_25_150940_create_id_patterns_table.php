<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_patterns', function (Blueprint $table) {
            $table->id();
            $table->string('pattern'); // e.g. ##-E###-##
            $table->string('regex');   // e.g. ^\d{2}-E\d{3}-\d{2}$
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
        Schema::dropIfExists('id_patterns');
    }
}
