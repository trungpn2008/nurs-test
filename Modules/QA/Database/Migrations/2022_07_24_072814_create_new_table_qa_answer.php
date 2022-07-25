<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableQaAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_answer', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('title');
            $table->bigInteger('parent_id')->nullable()->comment("parent");
            $table->bigInteger('qa_id')->nullable()->comment("qa id");
            $table->bigInteger('user_id')->nullable()->comment("user");
            $table->longText('content')->nullable()->comment("content");
            $table->tinyInteger('status')->nullable()->default(0)->comment('status');
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
        Schema::dropIfExists('qa_answer');
    }
}
