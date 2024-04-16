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

        Schema::table('lectures', function (Blueprint $table) {
            $table->string('name_ar')->after('name');
            $table->renameColumn('name', 'name_en');
        });
        Schema::table('lectures_pins', function (Blueprint $table) {
            $table->string('name_ar')->after('name');
            $table->renameColumn('name', 'name_en');
            $table->string('description_ar')->after('description');
            $table->renameColumn('description', 'description_en');
        });
        Schema::table('standards', function (Blueprint $table) {
            $table->string('name_ar')->after('name');
            $table->renameColumn('name', 'name_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->renameColumn('name_en', 'name');
        });
        Schema::table('lectures_pins', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->renameColumn('name_en', 'name');
            $table->dropColumn('description_ar');
            $table->renameColumn('description_en', 'description');
        });
        Schema::table('standards', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->renameColumn('name_en', 'name');
        });
    }
};
