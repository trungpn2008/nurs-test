<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('tiêu đề');
            $table->string('image')->nullable()->comment('image');
            $table->string('link')->nullable()->comment('link');
            $table->bigInteger('project_id')->nullable()->comment('id dự án');
            $table->bigInteger('blueprint_type_id')->nullable()->comment('id loại bản vẽ');
            $table->string('type')->nullable()->comment('Loại ảnh');
            $table->integer('arrange')->default(0)->nullable()->comment('sắp xếp');
            $table->integer('number')->nullable()->comment('số index bản ghi');
            $table->boolean('status')->default(1)->nullable()->comment('trạng thái');
            $table->index('project_id');
            $table->index('blueprint_type_id');
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
        Schema::dropIfExists('images');
    }
}
