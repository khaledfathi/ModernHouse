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
            $table->date('date')->nullable(false);
            $table->date('start_date')->nullable(false); 
            $table->date('end_date')->nullable(false); 
            $table->bigInteger('amount')->nullable(false); 
            $table->text('materials')->nullable(true); 
            $table->text('details')->nullable(true); 
            $table->timestamps();
            //FK
            $table->foreignId('user_id')->nullable(true)->references ('id')->on('users')->onDelete('set null'); 
            $table->foreignId('bill_id')->nullable(false)->default(null)->references ('id')->on('bills')->cascadeOnDelete(); 
            $table->foreignId('project_id')->nullable(true)->default(null)->references ('id')->on('projects')->cascadeOnDelete(); 
            $table->foreignId('transaction_type_id')->nullable(false)->references ('id')->on('transactions'); 
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
