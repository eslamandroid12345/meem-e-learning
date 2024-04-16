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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnUpdate()->nullOnDelete();
            $table->float('price');
            $table->float('app_price');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->json('goals')->nullable();
            $table->string('image')->nullable();
            $table->string('explanation_video')->nullable();
            $table->enum('explanation_video_platform' , ['YOUTUBE' , 'VIMEO' , 'SWARMIFY'])->default('YOUTUBE');
            $table->string('profile_file')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->float('duration')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('telegram_link')->nullable();
            $table->string('telegram_channel_link')->nullable();
            $table->boolean('show_teacher_names')->default(true);
            $table->boolean('important_flag')->default(true);
            $table->integer('sort')->default(1)->unsigned();
            $table->boolean('is_ratable')->default(true);
            $table->boolean('is_active')->default(true);
            $table->float('certificate_price')->nullable();
            $table->boolean('request_certificate_available')->default(true);
            $table->boolean('registration_status')->default(true);
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
        Schema::dropIfExists('courses');
    }
};
