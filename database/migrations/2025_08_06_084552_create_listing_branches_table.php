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
        Schema::create('listing_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings', 'id')->cascadeOnDelete();
            $table->json('address');
            $table->string('phone', 15)->nullable();
            $table->string('phone_alt', 15)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->foreignId('area_id')->constrained('areas', 'id')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_branches');
    }
};
