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
        Schema::create('certificate_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('print_request_id')->nullable()->constrained('print_requests')->cascadeOnUpdate()->nullOnDelete();
//            $table->string('name');
//            $table->string('email');
//            $table->string('phone');
//            $table->string('national_id');
//            $table->string('nationality');
//            $table->string('qualification');
//            $table->text('address');
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('certificate_user');
    }
};
