<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableQa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment("title");
            $table->bigInteger('qa_type')->comment("type");
            $table->bigInteger('qa_cate')->comment("qa cate");
            $table->bigInteger('category_id')->comment("category");
            $table->longText('content')->comment("content");
            $table->bigInteger('customer_id')->nullable()->comment("customer");
            $table->bigInteger('user_id')->nullable()->comment("user");
            $table->tinyInteger('status')->nullable()->default(0)->comment("status");
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
        Schema::dropIfExists('qa');
    }
}
