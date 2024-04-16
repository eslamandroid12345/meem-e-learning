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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
            $table->dropForeign(['cart_id']);
            $table->dropColumn('cart_id');
            $table->after('payment_type', function () use ($table) {
                $table->morphs('payable');
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
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('type', ['CART', 'CERTIFICATE'])->after('amount');
            $table->foreignId('course_id')->nullable()->after('cart_id')->constrained('courses')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('cart_id')->nullable()->constrained('carts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dropMorphs('payable');
        });
    }
};
