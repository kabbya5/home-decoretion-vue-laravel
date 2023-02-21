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
        Schema::create('developmentpagesilders', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('title');
            $table->string('work_type');
            $table->string('designer_name');
            $table->string('slider_image');
            $table->string('short_description');
            $table->longText('description');
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
        Schema::dropIfExists('developmentpagesilders');
    }
};
