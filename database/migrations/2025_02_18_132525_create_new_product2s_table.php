<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_product2s',function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->index();
            $table->string('added_by', 6)->default('admin');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('thumbnail_img', 100)->nullable();
            $table->string('video_link', 100)->nullable();
            $table->json('tags')->nullable()->index();
            $table->longText('description')->nullable();
            $table->decimal('unit_price', 20, 2)->index()->nullable();
            $table->decimal('purchase_price', 20, 2)->nullable();
            $table->boolean('variant_product')->default(false);
            $table->json('attributes')->nullable();
            $table->json('choice_options')->nullable();
            // New Fields for Conditions and Tags
            $table->json('conditions')->nullable(); // Multiple selectable conditions
            $table->enum('variant_type', ['single', 'multiple'])->default('single');
            $table->boolean('todays_deal')->default(false);
            $table->boolean('published')->default(true);
            $table->boolean('approved')->default(true);
            $table->string('stock_visibility_state', 10)->default('quantity');
            $table->boolean('cash_on_delivery')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('seller_featured')->default(false);
            $table->integer('current_stock')->default(0);
            $table->string('unit', 20)->nullable();
            $table->decimal('weight', 8, 2)->default(0.00);
            $table->integer('min_qty')->default(1);
            $table->integer('low_stock_quantity')->nullable();
            $table->decimal('discount', 20, 2)->nullable();
            $table->string('discount_type', 10)->nullable();
            $table->unsignedBigInteger('discount_start_date')->nullable();
            $table->unsignedBigInteger('discount_end_date')->nullable();
            $table->decimal('tax', 20, 2)->nullable();
            $table->string('tax_type', 10)->nullable();
            $table->string('shipping_type', 20)->default('flat_rate');
            $table->decimal('shipping_cost', 20, 2)->default(0.00);
            $table->integer('num_of_sale')->default(0);
            $table->string('meta_title', 255)->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_img', 255)->nullable();
            $table->string('slug')->unique();      
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->string('barcode', 255)->nullable();
            $table->timestamps();
            // Adding foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
            $table->foreign('childcategory_id')->references('id')->on('childcategories')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
        });
        
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_product2s');
    }
};
