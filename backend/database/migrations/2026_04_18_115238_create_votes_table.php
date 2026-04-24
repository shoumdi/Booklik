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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suggestion_id')->constrained('suggestion','id')->onDelete('cascade');
            $table->boolean('voted')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users','id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users','id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
