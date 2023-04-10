<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bitlinks', function (Blueprint $table) {
            $table->id();
            $table->string('bitlink_id');
            $table->string('domain');
            $table->string('slug');
            $table->text('long_url');
            $table->longText('title')->nullable();
            $table->json('tags')->default(json_encode([]));
            $table->json('custom_bitlinks')->default(json_encode([]));
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitlinks');
    }
};
