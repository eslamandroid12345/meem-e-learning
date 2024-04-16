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
        Schema::create('print_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', ['BOOK', 'CERTIFICATE']);
            $table->foreignId('course_id')->nullable()->constrained('courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('book_id')->nullable()->constrained('course_books')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('quantity')->unsigned()->default(1);
            $table->enum('status', ['ORDERED', 'APPROVED', 'DELIVERED', 'CANCELED'])->default('ORDERED');
            $table->foreignUuid('payment_id')->constrained('payments')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('print_requests');
    }
};
