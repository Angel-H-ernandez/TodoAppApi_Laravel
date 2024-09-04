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
        //
        Schema::create("task", function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->text("description")->nullable();
            $table->boolean("completed")->default(false);
            $table->timestamps();
            $table->bigInteger("group_task_id");
            $table->bigInteger("assigned_user_id");
            $table->text("priority")->nullable();
            $table->integer("progress_percentage")->default(0);
            $table->integer("duration_time")->nullable();
            $table->foreignId("created_by_id");
            $table->foreignId("task_agenda_id")->nullable();

            $table->foreign('group_task_id')->references('id')->on('group_task');
            $table->foreign('assigned_user_id')->references('id')->on('users');
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('task_agenda_id')->references('id')->on('task_agenda');


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        schema::dropIfExists("task");
    }
};
