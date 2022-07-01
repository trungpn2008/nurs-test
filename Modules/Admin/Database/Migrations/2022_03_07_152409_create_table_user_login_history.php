<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserLoginHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_login_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('id user');
            $table->timestamp('login_time')->nullable()->comment('Thời gian login');
            $table->timestamp('last_action_time')->nullable()->comment('Thời gian hoạt động lần cuối -> tính theo vào menu hoặc sử dụng action bất kỳ');
            $table->index(['user_id']);
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
        Schema::dropIfExists('user_login_history');
    }
}
