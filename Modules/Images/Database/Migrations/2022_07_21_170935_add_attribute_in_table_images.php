<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeInTableImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('image_left')->nullable()->comment('image left');
            $table->string('image_right')->nullable()->comment('image right');
            $table->string('icon')->nullable()->comment('icon');
            $table->text('intro')->nullable()->comment('intro');
            $table->text('intro2')->nullable()->comment('intro');
            $table->string('description')->nullable()->comment('description');
            $table->json('list_image')->nullable()->comment('list image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['number','image_left','image_right','icon','intro','intro2','description','list_image']);
        });
    }
}
