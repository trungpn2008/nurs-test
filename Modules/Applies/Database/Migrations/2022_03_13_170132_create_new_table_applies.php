<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableApplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('name');
            $table->string('email')->nullable()->comment('email');
            $table->string('phone')->nullable()->comment('phone');
            $table->string('file')->nullable()->comment('file');
            $table->bigInteger('recruitment_id')->nullable()->comment('id tuyển dụng');
            $table->boolean('status')->default(1)->nullable()->comment('trạng thái');
            $table->index('recruitment_id');
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
        Schema::dropIfExists('applies');
    }
}
