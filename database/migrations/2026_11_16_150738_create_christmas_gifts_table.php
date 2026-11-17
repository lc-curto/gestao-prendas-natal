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
        Schema::create('christmas_gifts', function (Blueprint $table) {
            $table->id();
            $table->string('gift_name');
            $table->decimal('expected_value', 10, 2);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('actual_value', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('christmas_gifts');
    }
};
