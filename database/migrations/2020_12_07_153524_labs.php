<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Labs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->text('logo')->nullable();
            $table->string('near')->nullable();
            $table->string('slug')->unique();
            $table->string('city')->nullable();
            $table->string('price')->nullable();
            $table->string('special_price')->nullable();
            $table->boolean('active',false);
            $table->string('discount')->nullable();
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
        Schema::dropIfExists('labs');
    }
}
