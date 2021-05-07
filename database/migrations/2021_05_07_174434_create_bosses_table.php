<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bosses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('difficulty', ['easy', 'medium', 'high']);
            $table->integer('rating')->default(10);
            $table->string('skin');
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
        Schema::dropIfExists('bosses');
    }
}
