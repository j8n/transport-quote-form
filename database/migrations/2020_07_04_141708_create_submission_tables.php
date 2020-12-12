<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Schema::create('categories', function (Blueprint $table) {
        //    $table->increments('id');
        //    $table->string('hashId')->nullable();
        //    $table->string('name')->nullable();
        //    $table->boolean('hasAddButton')->default(1);
        //    $table->string('iconClass')->nullable();
        //    $table->timestamps();
        //});
        //Schema::create('objects', function (Blueprint $table) {
        //    $table->increments('id');
        //    $table->string('hashId');
        //    $table->string('name')->nullable();
        //    $table->string('type')->nullable();
        //    $table->string('iconSrc')->nullable();
        //    $table->timestamps();
        //});
        //Schema::create('category_objects', function (Blueprint $table) {
        //    $table->increments('id');
        //    $table->bigInteger('category_id');
        //    $table->bigInteger('object_id');
        //    $table->timestamps();
        //});

        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hashId')->nullable();
            $table->string('contactInfo_name')->nullable();
            $table->string('contactInfo_phone')->nullable();
            $table->string('contactInfo_email')->nullable();
            $table->dateTime('contactInfo_date')->nullable();
            $table->timestamps();
        });

        Schema::create('submission_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hashId')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('city')->nullable();
            $table->string('type')->nullable();
            $table->string('floor')->nullable();
            $table->integer('submission_id');
            $table->timestamps();
        });

        Schema::create('submission_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hashId')->nullable();
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('categoryName')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('submission_id');
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
        //Schema::dropIfExists('categories');
        //Schema::dropIfExists('objects');
        //Schema::dropIfExists('category_objects');
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('submission_addresses');
        Schema::dropIfExists('submission_objects');
        
    }
}
