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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories','id')->nullOnDelete();
            $table->enum('status',['active','inactive'])->default('active');
            $table->text('image')->nullable()->default(null);
            $table->text('banner_image')->nullable()->default(null);
            $table->float('latitude')->nullable()->default(null);
            $table->float('longitude')->nullable()->default(null);
            $table->text('file')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
