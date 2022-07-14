<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableRecruitment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('tiêu đề');
            $table->string('description')->nullable()->comment('mô tả');
            $table->string('file')->nullable()->comment('file');
            $table->string('number')->nullable()->comment('số lượng');
            $table->date('time_end')->nullable()->comment('ngày hết hạn');
            $table->boolean('hot')->default(0)->nullable()->comment('hot');
            $table->integer('arrange')->default(0)->nullable()->comment('sắp xếp');
            $table->boolean('status')->default(1)->nullable()->comment('trạng thái');
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
        Schema::dropIfExists('recruitment');
    }
}
