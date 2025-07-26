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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->integer('id_client');
            $table->integer('id_category')->nullable()->comment('Danh mục cha');
            $table->integer('id_subcategory')->nullable()->comment('Danh mục con');
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện bài viết');
            $table->string('price')->nullable()->comment('Giá bán hoặc giá thỏa thuận');
            $table->integer('area')->nullable()->comment('Diện tích (m²)');
            $table->integer('bedrooms')->nullable()->comment('Số phòng ngủ');
            $table->integer('bathrooms')->nullable()->comment('Số phòng vệ sinh');
            $table->string('location')->nullable()->comment('Quận, Tỉnh/Thành phố');
            $table->string('address')->nullable()->comment('Địa chỉ cụ thể');
            $table->string('project_name')->nullable()->comment('Tên dự án (nếu có)');
            $table->string('phone')->nullable()->comment('Số điện thoại liên hệ');
            $table->string('zalo_link')->nullable()->comment('Link Zalo tư vấn');
            $table->string('map_link')->nullable()->comment('Link bản đồ / vị trí');
            $table->json('images')->nullable()->comment('Danh sách ảnh mô tả');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
