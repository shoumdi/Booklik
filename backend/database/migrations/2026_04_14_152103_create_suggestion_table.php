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
        Schema::create('suggestion', function (Blueprint $table) {
            $table->id();
            $table->foreignId("created_by")->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId("updated_by")->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('community_id')->nullable()->constrained('communities', 'id')->nullOnDelete();
            $table->foreignId('book_id')->nullable()->constrained('books', 'id')->nullOnDelete();
            $table->enum('status',['SUBMITTED','IN_PROGRESS','IMPLEMENTED','CANCELLED'])->default('SUBMITTED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggestion');
    }
};
