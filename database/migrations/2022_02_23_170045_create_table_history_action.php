<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHistoryAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_activity', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tiêu đề');
            $table->string('type')->nullable()->comment('Loại lịch sử');
            $table->string('cause_type')->nullable()->comment('Nguyên nhân');
            $table->text('action')->nullable()->comment('Hành động');
            $table->bigInteger('subject_id')->nullable()->comment('id hành động được ghi');
            $table->bigInteger('role_id')->nullable()->comment('Quyền của người hành động');
            $table->bigInteger('user_id')->nullable()->comment('Người hành động');
            $table->longText('result')->nullable()->comment('Kết quả');
            $table->json('data')->nullable()->comment('Dữ liệu hành động');
            $table->string('alert')->nullable()->comment('Cảnh báo');
            $table->boolean('status')->default(0)->nullable()->comment('Trạng thái');
            $table->index(['subject_id','role_id','user_id']);
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
        Schema::dropIfExists('history_action');
    }
}
