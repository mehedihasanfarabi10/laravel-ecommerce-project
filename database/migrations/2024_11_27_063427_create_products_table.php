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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->json('size');
            $table->json('color');
            $table->boolean('is_latest')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hot_deal')->default(false);
            $table->string('collection')->nullable();

            $table->unsignedBigInteger('category_id')->nullable()->after('category');
            $table->unsignedBigInteger('subcategory_id')->nullable()->after('category_id');
            $table->unsignedBigInteger('childcategory_id')->nullable()->after('subcategory_id');

            // Add foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('childcategories')->onDelete('cascade');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
