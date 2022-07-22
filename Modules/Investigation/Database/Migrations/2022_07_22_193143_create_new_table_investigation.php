<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableInvestigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigation', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('name');
            $table->string('email')->comment('email');
            $table->tinyInteger('inquiry_type')->comment('inquiry');
            $table->text('question')->comment('question');
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
        Schema::dropIfExists('investigation');
    }
}
