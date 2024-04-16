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
        Schema::table('book_solutions', function (Blueprint $table) {
            $table->dropColumn('video_link');
            $table->after('name_en', function () use ($table) {
                $table->enum('solution_video_platform', ["YOUTUBE" , "VIMEO" , "SWARMIFY"]);
                $table->string('solution_video_link');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_solutions', function (Blueprint $table) {
            $table->dropColumn('solution_video_platform');
            $table->dropColumn('solution_video_link');
            $table->string('video_link')->after('name_en');
        });
    }
};
