<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tên quyền');
            $table->string('description')->nullable()->comment('Mô tả quyền');
            $table->integer('prioritized')->nullable()->comment('Quyền ưu tiên');
            $table->boolean('non_delete')->nullable()->default(0)->comment('Không thể xóa');
            $table->boolean('status')->nullable()->default(1)->comment('Trạng thái');
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
        Schema::dropIfExists('roles');
    }
}
