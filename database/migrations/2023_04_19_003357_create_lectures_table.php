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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('standard_id')->constrained('standards')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', ['RECORDED', 'LIVE']);
            $table->string('name')->nullable();
            $table->string('description_ar');
            $table->string('description_en')->nullable();
            $table->string('live_link')->nullable();
            $table->enum('link_platform' , ["YOUTUBE" , "VIMEO" , "SWARMIFY"]);
            $table->string('record_link')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->integer('sort')->default(1)->unsigned();
            $table->boolean('is_published')->nullable();
            $table->timestamp('publish_at')->nullable();
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
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign(['standard_id']);
        });
        Schema::dropIfExists('lectures');
    }
};
