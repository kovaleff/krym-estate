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
        Schema::create('aparts', function (Blueprint $table) {
            $table->id();
            $table->char('title',45);
            $table->char('class',45)->nullable();
            $table->integer('meter_price')->nullable();
            $table->dateTime('finished')->nullable();
            $table->char('geodata',45)->nullable();

            $table->foreignId('developer_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apart');
    }
};
