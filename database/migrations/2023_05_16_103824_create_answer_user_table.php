<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('answer_id')->nullable()->constrained('answers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('question_id')->constrained('questions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('exam_user_id')->constrained('exam_user')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_user');
    }
};
