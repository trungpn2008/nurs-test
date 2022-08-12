<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHashtag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('name hashtag');
            $table->string('code')->nullable()->comment('code hashtag');
            $table->integer('count')->default(0)->nullable()->comment('count hashtag');
            $table->integer('view')->default(0)->nullable()->comment('view hashtag');
            $table->tinyInteger('status')->default(0)->nullable()->comment('code hashtag');
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
        Schema::dropIfExists('hashtag');
    }
}
