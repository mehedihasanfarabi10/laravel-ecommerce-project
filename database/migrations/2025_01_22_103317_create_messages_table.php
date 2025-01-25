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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('sender_id'); // Sender (user/admin)
            $table->unsignedBigInteger('receiver_id'); // Receiver
            $table->text('message')->nullable(); // Text message content
            $table->string('image_path')->nullable(); // Image file path
            $table->boolean('is_read')->default(false); // Read status
            $table->timestamps(); // Created/updated timestamps

            // Foreign keys
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
