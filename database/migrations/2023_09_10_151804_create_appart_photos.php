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
        Schema::create('apart_photos', function (Blueprint $table) {
            $table->id();
            $table->char('title', 45);
            $table->char('image');
            $table->char('geodata',45)->nullable();
            $table->foreignId('apart_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apart_photos');
    }
};
