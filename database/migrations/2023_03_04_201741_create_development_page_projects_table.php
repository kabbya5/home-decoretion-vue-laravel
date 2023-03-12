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
        Schema::create('development_page_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('development_page_category_id');
            $table->string('project_type');
            $table->string('title');
            $table->string('short_description');
            $table->longText('description')->nullable();
            $table->string('bed_room')->nullable();
            $table->string('wash_room')->nullable();
            $table->string('sqare_feet')->nullable();
            $table->string('price')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->string('gmail')->nullable(); 
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
        Schema::dropIfExists('development_page_projects');
    }
};
