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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('gender');
            $table->string('phone')->nullable(false)->change();
            $table->boolean('is_verified')->default(true)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('birth_date')->nullable()->after('address');
            $table->enum('gender' , ['MALE' , 'FEMALE'])->nullable()->after('phone');
            $table->string('phone')->nullable()->change();
            $table->dropColumn('is_verified');
        });
    }
};
