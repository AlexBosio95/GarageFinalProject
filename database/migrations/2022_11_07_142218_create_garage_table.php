<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedSmallInteger('sqmt')->nullable();
            $table->tinyInteger('length')->nullable();
            $table->tinyInteger('width')->nullable();
            $table->tinyInteger('height')->nullable();
            $table->tinyInteger('n_parking');
            $table->string('address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('image')->nullable();
            $table->boolean('available')->default(true);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('garages');
    }
}
