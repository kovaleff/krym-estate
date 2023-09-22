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
            $table->char('parse_link')->nullable()->change();
            $table->char('link')->nullable()->change();
            $table->char('city')->nullable()->change();
            $table->char('phone')->nullable()->change();
            $table->char('address')->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->json('attr')->nullable()->change();
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
