<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('important', ['easy', 'medium', 'high']);
            $table->unsignedBigInteger('player_id')->index();
            $table->integer('target');
            $table->float('current')->default(0)->nullable();
            $table->integer('sort')->default(10);
            $table->boolean('favorite')->default(false);
            $table->boolean('reached')->default(false);
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
        Schema::dropIfExists('goals');
    }
}
