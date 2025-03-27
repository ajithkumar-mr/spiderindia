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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->string('clas');
            $table->integer('no_of_days');
            $table->integer('no_of_period');
            $table->time('clas_time');
            $table->string('duration_class');
            $table->integer('no_of_breaks');
            $table->string('period_break1')->nullable();
            $table->string('duration_break1')->nullable();
            $table->string('period_break2')->nullable();
            $table->string('duration_break2')->nullable();
            $table->string('period_break3')->nullable();
            $table->string('duration_break3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
