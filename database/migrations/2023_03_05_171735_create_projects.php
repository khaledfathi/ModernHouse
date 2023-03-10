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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date')->nullable(false); 
            $table->date('start_date')->nullable(true); 
            $table->date('end_date')->nullable(true); 
            $table->integer('amount')->nullable(false); 
            $table->text('materials')->nullable(true); 
            $table->text('details')->nullable(true); 
            //FK
            $table->foreignId('user_id')->nullable(true)->references ('id')->on('users')->onDelete('set null'); 
            $table->foreignId('customer_id')->nullable(false)->references ('id')->on('customers')->cascadeOnDelete(); 
            $table->foreignId('project_status_id')->nullable(false)->references('id')->on('project_status')->cascadeOnDelete(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
