<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToIdPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('id_patterns', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('inactive')->after('regex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_patterns', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
