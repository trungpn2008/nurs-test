<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTermAndConditionCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termandconditioncategory', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('title');
            $table->bigInteger('parent_id')->nullable()->comment('parent');
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
        Schema::dropIfExists('termandconditioncategory');
    }
}
