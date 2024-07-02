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
            $table->string('title');
            $table->string('subtitle');
            $table->text('body');
            $table->float('price' ,6,2);
            $table->string('img')->default('/IMG/default.jpeg');
            $table->unsignedBigInteger('category_id')->onDelete('SET NULL');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories');
            $table->unsignedBigInteger('user_id')->onDelete('SET NULL');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
                    
            $table->timestamps();
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
