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
        Schema::create('community_book', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['AVAILABLE', 'BOOKED', 'SHIPPING'])->default('SHIPPING');
            $table->foreignId('book_id')->nullable()->constrained('books', 'id')->nullOnDelete();
            $table->foreignId('community_id')->nullable()->constrained('communities', 'id')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('updateded_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_book');
    }
};
