<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_add_is_read_to_bookings_table.php
public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->boolean('is_read')->default(false);
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('is_read');
    });
}

};
