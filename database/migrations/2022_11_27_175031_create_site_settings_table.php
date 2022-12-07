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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_phone_2')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_email_2')->nullable();
            $table->text('seo_tag')->nullable();
            $table->text('seo_content')->nullable();
            $table->string('title_image')->nullable();
            $table->string('share_image')->nullable();
            $table->longText('trean_and_conditon')->nullable;
            $table->longText('return_policy')->nallable;
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
        Schema::dropIfExists('site_settings');
    }
};
