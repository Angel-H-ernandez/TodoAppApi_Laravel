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
        Schema::create('task_agenda', function (Blueprint $table) {
            $table->id();
            $table->time("monday");
            $table->time("tuesday");
            $table->time("wednesday");
            $table->time("thursday");
            $table->time("friday");
            $table->time("saturday");
            $table->time("sunday");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('task_agenda');
    }
};
