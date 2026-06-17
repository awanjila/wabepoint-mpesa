<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('category_name');
                $table->string('slug')->nullable()->unique();
                $table->string('meta_title')->nullable();
                $table->text('category_description')->nullable();
                $table->string('category_image')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
