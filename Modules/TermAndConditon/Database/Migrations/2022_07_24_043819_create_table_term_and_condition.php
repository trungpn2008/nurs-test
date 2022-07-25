<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTermAndCondition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termandcondition', function (Blueprint $table) {
            $table->id();
            $table->string("title")->comment("title");
            $table->longText("content")->nullable()->comment("content");
            $table->bigInteger("category_id")->nullable()->comment("category");
            $table->integer("arrange")->nullable()->default(0)->comment("arrange");
            $table->tinyInteger("status")->nullable()->default(0)->comment("status");
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
        Schema::dropIfExists('termandcondition');
    }
}
