<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserOverwriteHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_overwrite_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('User được ghi đè');
            $table->bigInteger('user_role_id')->comment('Quyền user được ghi đè');
            $table->bigInteger('user_overwrite_id')->comment('User ghi đè');
            $table->bigInteger('user_overwrite_role_id')->comment('Quyền user ghi đè');
            $table->integer('time_overwrite')->nullable()->comment('Thời gian ghi đè');
            $table->index(['user_id','user_role_id']);
            $table->index(['user_overwrite_id']);
            $table->index(['user_overwrite_role_id']);
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
        Schema::dropIfExists('user_overwrite_history');
    }
}
