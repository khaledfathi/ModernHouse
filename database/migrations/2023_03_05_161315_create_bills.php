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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name',100)->nullable(false); 
            $table->string('customer_phone',100)->nullable(false); 
            $table->date('date')->nullable(false);
            $table->time('time')->nullable(false);
            $table->enum('status',['ok', 'returned'])->nullable(false);
            $table->timestamps();
            //FK
            $table->foreignId('customer_id')->nullable(true)->default(null)->references('id')->on('customers')->onDelete('set null'); 
            $table->foreignId('user_id')->nullable(true)->default(null)->references('id')->on('users')->onDelete('set null'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill');
    }
};
