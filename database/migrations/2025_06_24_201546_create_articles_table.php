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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('fund_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lot_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('ref')->unique();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->json('dimensions')->nullable();
            $table->json('techniques')->nullable();
            $table->text('inscriptions')->nullable();
            $table->json('geography')->nullable();
            $table->text('storage_cond')->nullable();
            $table->string('subtitle')->nullable();
            $table->smallInteger('year_from')->nullable();
            $table->smallInteger('year_to')->nullable();
            $table->string('collation')->nullable();
            $table->string('state')->nullable();
            $table->string('language')->nullable();
            $table->json('legacy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
