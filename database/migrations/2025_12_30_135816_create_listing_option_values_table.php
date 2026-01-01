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
        Schema::create('listing_option_value', function (Blueprint $table) {
            $table->foreignId('listing_id')->constrained('listings','id')->cascadeOnDelete();
            $table->foreignId('option_value_id')->constrained('option_values','id')->cascadeOnDelete();
            $table->primary(['listing_id', 'option_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_option_value');
    }
};
