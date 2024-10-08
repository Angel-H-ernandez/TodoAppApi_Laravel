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
        Schema::create('group_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_main_id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('user_main_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('group_task');
    }
};
