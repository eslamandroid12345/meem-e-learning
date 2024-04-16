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
        Schema::create('course_books', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->foreignId('course_id')->nullable()->constrained('courses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('book_pdf')->nullable();
            $table->float('price');
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('image')->nullable();
            $table->boolean("show_in_store")->default(false);
//            $table->boolean('is_bw')->default(false);
//            $table->float('bw_price')->nullable();
//            $table->boolean('is_coloured')->default(false);
//            $table->float('coloured_price')->nullable();
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
        Schema::dropIfExists('course_books');
    }
};
