<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot table for product-color relationship
        Schema::create('product_color', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->constrained('product_colors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_color');
        Schema::dropIfExists('product_colors');
    }
};
