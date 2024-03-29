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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 255)->nullable(false); 
            $table->text('description')->nullable(true); 
            $table->bigInteger('price')->nullable(false); 
            $table->text('image')->nullable(true); 
            $table->bigInteger('quantity')->nullable(false); 
            $table->timestamps();
            //FK
            $table->foreignId('user_id')->nullable(true)->default(null)->references ('id')->on('users'); 
            $table->foreignId('category_id')->nullable(true)->references ('id')->on('categories')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
