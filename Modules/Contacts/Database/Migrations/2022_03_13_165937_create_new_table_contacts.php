<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('Tên');
            $table->string('email')->nullable()->comment('email');
            $table->string('phone')->nullable()->comment('phone');
            $table->bigInteger('project_id')->nullable()->comment('id dự án');
            $table->text('note')->nullable()->comment('ghi chú');
            $table->boolean('status')->default(1)->nullable()->comment('trạng thái');
            $table->index('project_id');
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
        Schema::dropIfExists('contacts');
    }
}
