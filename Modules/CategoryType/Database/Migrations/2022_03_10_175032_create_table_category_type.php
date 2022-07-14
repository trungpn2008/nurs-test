<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategoryType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_type', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tiêu đề');
            $table->string('code')->comment('mã');
            $table->string('non_delete')->default(0)->nullable()->comment('Không thể xóa');
            $table->boolean('status')->default(1)->nullable()->comment('Trạng thái');
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
        Schema::dropIfExists('category_type');
    }
}
