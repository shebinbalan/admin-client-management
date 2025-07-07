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
        Schema::create('assigned_texts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('pending'); // new
            $table->date('deadline')->nullable(); // new
            $table->text('notes')->nullable(); // new
            $table->unsignedTinyInteger('priority')->default(3); // new
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_texts');
    }
};
