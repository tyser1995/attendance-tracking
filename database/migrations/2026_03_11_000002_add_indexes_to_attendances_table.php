<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->index('idnumber');
            $table->index('created_date');
            $table->index(['idnumber', 'created_date']);
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex(['idnumber']);
            $table->dropIndex(['created_date']);
            $table->dropIndex(['idnumber', 'created_date']);
        });
    }
}
