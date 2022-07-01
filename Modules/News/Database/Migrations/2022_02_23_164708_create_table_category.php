<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable()->comment('id cha');
            $table->string('title')->comment('Tiêu đề');
            $table->longText('description')->nullable()->comment('Mô tả');
            $table->string('image')->nullable()->comment('Hình ảnh');
            $table->string('url')->nullable()->comment('Đường dẫn');
            $table->string('icon')->nullable()->comment('Icon');
            $table->string('color')->nullable()->comment('Màu');
            $table->string('type')->nullable()->comment('Màu');
            $table->integer('arrange')->default(0)->nullable()->comment('Sắp xếp');
            $table->boolean('status')->default(0)->nullable()->comment('Trạng thái');
            $table->bigInteger('creator')->nullable()->comment('Người tạo');
            $table->bigInteger('updater')->nullable()->comment('Người cập nhật');
            $table->index(['parent_id','creator','updater']);
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
        Schema::dropIfExists('category');
    }
}
