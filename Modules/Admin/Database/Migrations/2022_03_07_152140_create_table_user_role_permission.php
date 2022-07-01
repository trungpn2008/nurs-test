<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserRolePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_permission', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('id user');
            $table->bigInteger('role_id')->comment('id quyền');
            $table->json('permission')->nullable()->comment('Nhóm chứng chỉ thêm ngoài quyền');
            $table->string('code_overwrite')->nullable()->comment('Mã quyền ghi đè');
            $table->boolean('status')->nullable()->default(1)->comment('Trạng thái');
            $table->index(['user_id','role_id']);
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
        Schema::dropIfExists('user_role_permission');
    }
}
