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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('tasks_group_id');
            $table->foreign('tasks_group_id')->references('id')->on('tasks_groups')->onDelete('cascade');
            $table->string('title');
            $table->string('type');
            $table->text('description');
            $table->text('tests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
