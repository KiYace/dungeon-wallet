<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayresLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playres_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id')->index();
            $table->integer('level')->default(1);
            $table->integer('exp')->nullable()->default(0);
            $table->integer('points')->nullable()->default(0);
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
        Schema::dropIfExists('playres_levels');
    }
}
