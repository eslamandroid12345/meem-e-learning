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
        Schema::create('exams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['LECTURE', 'STANDARD', 'COURSE']);
            $table->foreignId('lecture_id')->nullable()->constrained('lectures')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('standard_id')->nullable()->constrained('standards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained('courses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('duration');
            $table->integer('attempts')->nullable();
            $table->enum('solution_video_platform' , ["YOUTUBE" , "VIMEO" , "SWARMIFY"])->nullable();
            $table->string('solution_video_link')->nullable();
            $table->boolean('is_free')->default(false);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('exams');
    }
};
