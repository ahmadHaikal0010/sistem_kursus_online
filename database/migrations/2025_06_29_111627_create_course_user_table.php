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
        Schema::create('haikal_course_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'haikal_users',
                indexName: 'course_user_user_id'
            );
            $table->foreignId('course_id')->constrained(
                table: 'haikal_courses',
                indexName: 'course_user_course_id'
            );
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
    }
};
