<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableChooseProfileCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chosse_profile_category', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment("title");
            $table->string('name_input')->comment('name input');
            $table->tinyInteger('required')->nullable()->default(0)->comment('required');
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
        Schema::dropIfExists('chosse_profile_category');
    }
}
