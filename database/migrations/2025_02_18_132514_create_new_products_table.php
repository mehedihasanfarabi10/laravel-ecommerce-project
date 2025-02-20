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
        Schema::create('new_product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->index();
            $table->string('added_by', 6)->default('admin');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('childcategory_id')->nullable();

            $table->json('gallery_images')->nullable();
            $table->string('thumbnail_img', 100)->nullable();
            $table->string('video_provider', 20)->nullable();
            $table->string('video_link', 100)->nullable();
            $table->string('tags', 500)->nullable()->index();
            $table->longText('description')->nullable();

            $table->decimal('unit_price', 20, 2)->index()->nullable();
            $table->decimal('purchase_price', 20, 2)->nullable();
            $table->boolean('variant_product')->default(false);
            $table->json('attributes')->default(json_encode([]));
            $table->json('choice_options')->nullable();
            $table->json('colors')->nullable();
            $table->json('variations')->nullable();

            // New Fields for Conditions and Tags
            $table->json('tags')->nullable(); // Multiple selectable tags
            $table->json('conditions')->nullable(); // Multiple selectable conditions
            $table->json('sizes')->nullable(); // Multiple selectable sizes

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
            $table->boolean('is_quantity_multiplied')->default(false);
            $table->integer('est_shipping_days')->nullable();
            $table->integer('num_of_sale')->default(0);

            $table->string('meta_title', 255)->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_img', 255)->nullable();
            $table->string('pdf', 255)->nullable();

            $table->string('slug')->unique();
            $table->decimal('earn_point', 8, 2)->default(0.00);
            $table->boolean('refundable')->default(false);
            $table->decimal('rating', 3, 2)->default(0.00);

            $table->string('barcode', 255)->nullable();
            $table->boolean('digital')->default(false);
            $table->boolean('auction_product')->default(false);
            $table->string('file_name', 255)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->string('external_link', 500)->nullable();
            $table->string('external_link_btn', 255)->default('Buy Now');
            $table->boolean('wholesale_product')->default(false);

            $table->timestamps();

            // Adding foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('childcategories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_products');
    }
};
