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
        Schema::create('course_inquiries', function (Blueprint $table) {
            $table->id();
            $table->enum('type' , ['EDUCATIONAL' , 'TECHNICAL']);
            $table->string('question');
            $table->longText('answer')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('is_public')->default(false);
            $table->foreignId('course_id')->constrained('courses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('course_inquiries');
    }
};
