<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('aparts', function (Blueprint $table) {
            $table->char('parse_link');
            $table->char('link');
            $table->char('city');
            $table->char('phone');
            $table->char('address');
            $table->text('content');
            $table->json('attr');

            $table->dropColumn('meter_price');
            $table->dropColumn('class');
            $table->dropColumn('finished');
            $table->dropColumn('geodata');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aparts', function (Blueprint $table) {
            //
        });
    }
};
