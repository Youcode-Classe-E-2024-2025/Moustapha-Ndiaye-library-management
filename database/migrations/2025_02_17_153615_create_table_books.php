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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('imgURL', 100);
            $table->boolean('isAvailable')->default(true);
            $table->string('borrowsBY', 100)->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->foreignId('category_id')->constrained('categories')->onDelete('set null'); // Clé étrangère vers categories
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
