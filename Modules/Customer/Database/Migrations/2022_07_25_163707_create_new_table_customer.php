<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment('name');
            $table->string("email")->comment('email');
            $table->string("phone")->nullable()->comment('phone');
            $table->string("furigana")->comment('Furigana');
            $table->string("user_name")->comment('username');
            $table->string("password")->comment('username');
            $table->string("remember")->comment('remember token');
            $table->string("avatar")->nullable()->comment('avatar');
            $table->integer("day_of_birth")->nullable()->comment('day of birth');
            $table->integer("month_of_birth")->nullable()->comment('month of birth');
            $table->integer("year_of_birth")->nullable()->comment('year of birth');
            $table->longText("content_profile")->nullable()->comment('profile');
            $table->json("data_choose")->nullable()->comment('data choose');
//            $table->json("relationship_id")->nullable()->comment('relationship');
//            $table->integer("dementia_id")->nullable()->comment('dementia');
//            $table->integer("degree_of_care_required_id")->nullable()->comment('Degree of care required');
//            $table->integer("long_term_care_situation_id")->nullable()->comment('Long-term care situation');
//            $table->bigInteger("contact_id")->nullable()->comment('contact');
//            $table->integer("age_id")->nullable()->comment('age');
            $table->tinyInteger("gender")->nullable()->comment('gender');
            $table->text("address")->nullable()->comment('address');
            $table->text("address2")->nullable()->comment('address2');
            $table->string("zipcode")->nullable()->comment('zipcode');
            $table->string("pass_port")->nullable()->comment('passport');
            $table->tinyInteger("covered")->nullable()->default(0)->comment('covered ');
            $table->tinyInteger("status")->nullable()->default(0)->comment('status');
            $table->tinyInteger("verify")->nullable()->default(0)->comment('verify');
            $table->tinyInteger("ban")->nullable()->default(0)->comment('ban');
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
        Schema::dropIfExists('customer');
    }
}
