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
        Schema::table('schedules', function (Blueprint $table) {
            $table->date('Date')->nullable()->change();
            $table->string('Day')->nullable()->change();
            $table->time('Time')->nullable()->change();
            $table->integer('Subject_Code')->nullable()->change();
            $table->integer('Room')->nullable()->change();
            $table->foreignId('Instructor_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->date('Date')->nullable(false)->change();
            $table->string('Day')->nullable(false)->change();
            $table->time('Time')->nullable(false)->change();
            $table->integer('Subject_Code')->nullable(false)->change();
            $table->integer('Room')->nullable(false)->change();
            $table->foreignId('Instructor_id')->nullable(false)->change();
        });
    }
};
