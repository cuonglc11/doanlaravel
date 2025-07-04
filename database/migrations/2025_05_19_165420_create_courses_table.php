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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->nullable();
            $table->string('description');
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price' , 10,2)->default(0);
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('category_courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
