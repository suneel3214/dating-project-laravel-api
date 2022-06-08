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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('about')->nullable();
            $table->string('age')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('sexuality')->nullable();
            $table->string('gender')->nullable();
            $table->string('drinking')->nullable();
            $table->string('smoking')->nullable();
            $table->string('contact')->nullable();
            $table->string('eye')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('hair_length')->nullable();
            $table->string('body_size')->nullable();
            $table->string('image')->nullable();
            
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
        Schema::dropIfExists('user_profiles');
    }
};
