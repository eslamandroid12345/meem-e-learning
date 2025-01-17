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
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_ar');
            $table->foreignId('lecture_id')->constrained('lectures')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('standard_id')->constrained('standards')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('indicators', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['standard_id']);
        });
        Schema::dropIfExists('indicators');
    }
};
