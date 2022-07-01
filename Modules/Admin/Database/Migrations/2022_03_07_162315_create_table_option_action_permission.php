<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOptionActionPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_action_permission', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tên action');
            $table->string('code')->comment('Mã action');
            $table->boolean('status')->default(1)->nullable()->comment('Trạng thái');
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
        Schema::dropIfExists('option_action_permission');
    }
}
