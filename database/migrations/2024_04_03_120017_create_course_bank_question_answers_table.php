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
        Schema::create('course_bank_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('course_bank_questions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('content');
            $table->text('comment')->nullable();
            $table->boolean('is_correct')->default(false);
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
        Schema::dropIfExists('course_bank_question_answers');
    }
};
