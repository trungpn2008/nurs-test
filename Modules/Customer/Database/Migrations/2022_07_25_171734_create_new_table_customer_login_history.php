<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableCustomerLoginHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_login_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_login')->comment('id customer login');
            $table->timestamp('login_at')->nullable()->comment('login at');
            $table->string('device_id')->nullable()->comment('device id');
            $table->string('device_type')->nullable()->comment('device type');
            $table->string('fcm')->nullable()->comment('fcm');
            $table->timestamp('logout')->nullable()->comment('logout');
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
        Schema::dropIfExists('customer_login_history');
    }
}
