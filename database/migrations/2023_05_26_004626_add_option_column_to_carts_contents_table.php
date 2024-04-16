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
        Schema::table('carts_contents', function (Blueprint $table) {
            $table->enum('option', ['PRINT', 'PDF'])->nullable()->after('cartable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts_contents', function (Blueprint $table) {
            $table->dropColumn('option');
        });
    }
};
