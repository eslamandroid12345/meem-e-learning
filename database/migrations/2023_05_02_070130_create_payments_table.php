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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('payment_type', ['CASH', 'EPAYMENT', 'TAMARA']);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('cart_id')->nullable()->constrained('carts')->nullOnDelete()->cascadeOnUpdate();
            $table->float('amount')->unsigned();
            $table->enum('type', ['CART', 'CERTIFICATE']);
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_declined')->default(false);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('from_bank')->nullable();
            $table->string('to_bank')->nullable();
            $table->string('transfer_amount')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('transfer_time')->nullable();
//            $table->string('nationality')->nullable();
//            $table->string('national_id')->nullable();
            $table->string('qualification')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
