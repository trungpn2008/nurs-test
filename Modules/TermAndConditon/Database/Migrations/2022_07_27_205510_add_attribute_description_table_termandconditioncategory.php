<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeDescriptionTableTermandconditioncategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('termandconditioncategory', function (Blueprint $table) {
            $table->text('description')->nullable()->comment("description");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('termandconditioncategory', function (Blueprint $table) {
            //
        });
    }
}
