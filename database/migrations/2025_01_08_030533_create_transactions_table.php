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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId')->unsigned()->nullable();
            $table->foreign('userId')->nullable()->constrained()->references('id')->on('products')->onDelete('cascade')->nullable();
            $table->bigInteger('productId')->unsigned()->nullable();
            $table->foreign('productId')->nullable()->constrained()->references('id')->on('products')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
