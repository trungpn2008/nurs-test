<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableListProfileOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_profile_option', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('title');
            $table->string('choose_category_id')->comment('choose category id');
            $table->tinyInteger('status')->nullable()->default(1)->comment('status');
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
        Schema::dropIfExists('list_profile_option');
    }
}
