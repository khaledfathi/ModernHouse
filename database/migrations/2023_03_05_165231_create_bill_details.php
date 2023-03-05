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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name' , 255)->nullable(false);
            $table->bigInteger('price')->nullable(false); 
            $table->bigInteger('quantity')->nullable(false); 
            $table->bigInteger('total')->nullable(false); 
            $table->timestamps();
            //FK
            $table->foreignId('bill_id')->nullable(false)->references ('id')->on('bills')->cascadeOnDelete(); 
            $table->foreignId('product_id')->nullable(true)->references ('id')->on('products')->cascadeOnDelete(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
