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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('slider_id')->nullable();
            $table->unsignedBigInteger('seller_id');
            $table->string('product_title')->unique();
            $table->string('slug');
            $table->string('price');
            $table->string('discount_price')->nullable();
            $table->text('short_text');
            $table->text('description')->nullable();
            $table->string('quantity');
            $table->string('weight')->nullable();
            $table->string('free_shipping')->nullable();
            $table->string('top_rated')->nullable();
            $table->integer('is_weekly_sale')->nullable();
            $table->string('view_count')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
