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
        if(!Schema::hasTable('attendances')){
            Schema::create('attendances', function (Blueprint $table) {
                $table->id();
                $table->time('time_in');
                $table->string('picture')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('subject_code');
                $table->string('description');
                $table->string('schedule');
                $table->string('room');
                $table->integer('instructor_id');
                $table->timestamps();
            });
        };
    }
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
