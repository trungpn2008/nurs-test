<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alias', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('tiêu đề');
            $table->string('slug')->nullable()->comment('tiêu đề slug');
            $table->string('sub_slug')->nullable()->comment('tiêu đề sub slug');
            $table->text('description')->nullable()->comment('mô tả');
            $table->bigInteger('category_id')->nullable()->comment('category id');
            $table->bigInteger('news_id')->nullable()->comment('new id');
            $table->bigInteger('recruitment_id')->nullable()->comment('recruitment id');
            $table->bigInteger('project_id')->nullable()->comment('project id');
            $table->boolean('status')->default(1)->nullable()->comment('trạng thái');
            $table->index('category_id');
            $table->index('news_id');
            $table->index('recruitment_id');
            $table->index('project_id');
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
        Schema::dropIfExists('alias');
    }
}
