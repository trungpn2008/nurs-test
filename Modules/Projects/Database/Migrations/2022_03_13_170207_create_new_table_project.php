<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable()->comment('id danh mục');
            $table->string('title')->nullable()->comment('name');
            $table->string('image')->nullable()->comment('ảnh');
            $table->string('address')->nullable()->comment('địa chỉ');
            $table->longText('info')->nullable()->comment('thông tin tổng quan');
            $table->longText('location')->nullable()->comment('vị trí');
            $table->text('location_url')->nullable()->comment('link map');
            $table->longText('utilities_left')->nullable()->comment('tiện ích trái');
            $table->longText('utilities_right')->nullable()->comment('tiện ích phải');
            $table->json('reason_buy')->nullable()->comment('lý do chọn mua');
            $table->boolean('hot')->default(0)->nullable()->comment('hot');
            $table->integer('arrange')->default(0)->nullable()->comment('sắp xếp');
            $table->json('data')->nullable()->comment('dữ liệu');
            $table->boolean('status')->default(1)->nullable()->comment('trạng thái');
            $table->index('category_id');
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
        Schema::dropIfExists('projects');
    }
}
