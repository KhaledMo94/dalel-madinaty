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
        Schema::create('category_option', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('options','id')->cascadeOnDelete();
            $table->primary(['category_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_option');
    }
};
