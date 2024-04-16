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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('exam_id')->constrained('exams')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('indicator_id')->nullable()->constrained('indicators')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('standard_id')->nullable()->constrained('standards')->cascadeOnUpdate()->nullOnDelete();
            $table->longText('content');
            $table->float('degree')->unsigned();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('questions');
    }
};
