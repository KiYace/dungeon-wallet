<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playres', function (Blueprint $table) {
            $table->id();
            $table->string('nickname', 12);
            $table->string('mail', 45);
            $table->string('password', 255);
            $table->unsignedBigInteger('skin_id')->index();
            $table->boolean('push_enabled')->default(true);
            $table->string('push_token', 256);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playres');
    }
}
