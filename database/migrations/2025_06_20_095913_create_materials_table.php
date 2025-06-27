<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('haikal_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained(
                table: 'haikal_courses',
                indexName: 'materials_courses_id'
            );
            $table->string('title');
            $table->enum('type', ['text', 'video', 'link'])->default('text');
            $table->text('content')->nullable();
            $table->string('video_path')->nullable(); // untuk upload
            $table->string('video_link')->nullable(); // untuk link YouTube
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
