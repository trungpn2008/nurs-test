<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('tiêu đề');
            $table->string('alias')->nullable()->comment('alias');
            $table->bigInteger('category_id')->nullable()->comment('Danh mục');
            $table->bigInteger('option_id')->nullable()->comment('Danh mục');
            $table->text('short_description')->nullable()->comment('Mô tả ngắn');
            $table->longText('description')->nullable()->comment('Mô tả');
            $table->text('note')->nullable()->comment('ghi chú');
            $table->text('hashtag')->nullable()->comment('Hashtag');
            $table->string('image')->nullable()->comment('Hình ảnh');
            $table->string('url')->nullable()->comment('Đường dẫn');
            $table->string('source')->nullable()->comment('Nguồn bài viết');
            $table->json('interactive')->nullable()->comment('Tương tác');
            $table->integer('view')->default(0)->nullable()->comment('Lượt xem');
            $table->integer('arrange')->default(0)->nullable()->comment('Sắp xếp');
            $table->integer('hot')->default(0)->nullable()->comment('Tin hot');
            $table->boolean('status')->default(0)->comment('trạng thái');
            $table->bigInteger('creator')->nullable()->comment('Người tạo');
            $table->bigInteger('updater')->nullable()->comment('Người cập nhật');
            $table->timestamp('timer')->nullable()->comment('Hẹn giờ');
            $table->index(['category_id','option_id','creator','updater']);
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
        Schema::dropIfExists('news');
    }
}
