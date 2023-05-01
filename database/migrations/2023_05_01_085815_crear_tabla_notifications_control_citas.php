<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_control_citas', function (Blueprint $table) {
            $table->id();
            $table->integer('ncc_cita_id');
            $table->integer('ncc_menos_diez')->nullable();
            $table->integer('ncc_menos_cinco')->nullable();
            $table->integer('ncc_menos_un_dia')->nullable();
            $table->integer('ncc_inicio')->nullable();
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
        Schema::dropIfExists('notifications_control_citas');
    }
};
